<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendeeRequest;
use App\Models\AccessibilityOption;
use App\Models\AccessibilityOptionAttendee;
use App\Models\Community;
use App\Models\DietaryRestriction;
use App\Models\DietaryRestrictionAttendee;
use App\Models\Guest;
use App\Models\Organization;
use App\Models\Recipient;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AttendeeController extends Controller
{

    public function rsvpStatus() {
        $data['attendees'] = Attendee::where('type', 'recipient')->where('status', 'attending')->orWhere('status', 'declined')->get();

        $data['columns'][] = ['label' => 'First',       'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Last',        'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Ceremony',    'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Org.',        'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Milestone',   'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Status',      'orderable' => 'true'];
        $data['columns'][] = ['label' => 'Has Guest?',  'orderable' => 'true'];




        return view('admin.attendees.rsvp-status', $data);

    }

    public function updateRSVPStatus($rid, Request $request) {

        $recipient = Recipient::find($rid);
        $recipient->attendee->status = $request->status;
        $recipient->attendee->save();

        return redirect('ceremony/rsvpstatus');

    }

    public function rsvpBuild(string $identifier)
    {
        //IS THIS A VALID RSVP?
        $data['attendee'] = Attendee::where('identifier', $identifier)->first();

        if (!isset($data['attendee']->status) || $data['attendee']->status != 'invited') {
            return view('rsvp.friendly-fail', $data);
        }



            $data['diet']           = DietaryRestriction::all('short_name');
            $data['access']         = AccessibilityOption::all('short_name', 'description');
            $data['communities']    = Community::all('id','name');
            $data['rid']            = $data['attendee']->recipient->id;
            $data['recipient']      = $data['attendee']->recipient;
            $data['jsonBundle']['diet'] = $data['diet'];
            $data['jsonBundle']['access'] = $data['access'];
            $data['jsonBundle']['communities'] = $data['communities'];
            $data['jsonBundle']['csrftoken'] = csrf_token();

            //RSVP form requires a specific datetime format.


            $data['scheduled_datetime'] = new DateTime($data['attendee']->ceremony->scheduled_datetime);
            return view('rsvp.rsvp-plain', $data);

    }

    public function viewRSVPCodes() {
        $data['attendees'] = Attendee::all();

        return view('admin.attendees.attendeeList', $data);

    }

    /**
     * @param AttendeeRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function collectRsvp(AttendeeRequest $request) {

        //Get Recipient from Session
        $recipient = Recipient::find($request->recipid);

        //Are they coming?
        if ($request->rsvp === 'true') :
            //Are they bringing a guest?
            if ($request->guest === 'true') :
                //Create a guest record associated with recipient, and an attendee record for guest.
                $guest = $recipient->guest()->create();
                $guest->attendee()->create(['ceremony_id' => $recipient->attendee->ceremony->id, 'type' => 'guest', 'guest_id' => $guest->id, 'status' => 'attending']);
                $guest->attendee->save();
                $guest->save();
                $recipient->save();
            endif;

            //Accommodations
            $this->updateDietaryRecords('recip_', $recipient->attendee, $request);
            $this->updateAccessibilityRecords('recip_', $recipient->attendee, $request);
            if ($request->guest === 'true')
            {
                $this->updateAccessibilityRecords('guest_', $recipient->guest->attendee, $request);
                $this->updateDietaryRecords('guest_', $recipient->guest->attendee, $request);
            }

            $recipient->attendee->status = 'attending';
        else: //RECIPIENT DECLINED
            $recipient->attendee->status = 'declined';

            $recipient->office_address_prefix           = $request->office_address_prefix;
            $recipient->office_address_suite            = $request->office_address_suite;
            $recipient->office_address_street_address   = $request->office_address_street_address;
            $recipient->office_address_postal_code      = $request->office_address_postal_code;
            $recipient->office_address_community_id     = $request->office_address_community_id;


        endif;

        if ($request->contact_update === 'true') :
            $updateParams = [
                'government_phone_number',
                'personal_phone_number',
                'government_email',
                'personal_email',
                'preferred_contact',
            ];
            foreach ($updateParams as $param) :
                if (!empty($request->$param)) {
                    $recipient->$param = $request->$param;
                }
            endforeach;
                $data['updated_contact'] = true;
            else:
                $data['updated_contact'] = false;
        endif; //end contact update


        if ($request->retiring === 'true'):
            $recipient->retiring_this_year  = true;
            $recipient->retirement_date     = $request->retirement_date;
            $recipient->personal_phone_number      = $request->personal_phone;
            $recipient->personal_email      = $request->personal_email;
            $recipient->preferred_contact   = 'personal';
        endif;

        $recipient->attendee->save();
        $recipient->save();
        $data['recipient'] = $recipient;
        return view('rsvp.confirmation', $data);
    }


    /**
     * @param Attendee $attendee
     * @param $choices
     */
    private function updateDietaryRecords(String $prefix, Attendee $attendee,  $request)
    {
        $dietaryRestrictions = [];
        foreach(DietaryRestriction::all() as $restrictionOption)
        {
            //Formfield string is needed to distinguish between recipients and guests using the same options
            $formfield = $prefix . $restrictionOption->short_name;
            if (!empty($request->$formfield) && $request->$formfield === 'true')
            {
                $dietaryRestrictions[] = $restrictionOption->id;
            }
        }

        $attendee->dietaryRestrictions()->sync($dietaryRestrictions);
        $attendee->save();

    }

    /**
     * @param Attendee $attendee
     * @param $choices
     */
    private function updateAccessibilityRecords(String $prefix, Attendee $attendee,  $request)
    {
        $accessibilityOptions = [];
        foreach(AccessibilityOption::all() as $accessibilityOption)
        {
            //Formfield string is needed to distinguish between recipients and guests using the same options
            $formfield = $prefix . $accessibilityOption->short_name;
            if (!empty($request->$formfield) && $request->$formfield === 'true')
            {
                $accessibilityOptions[] = $accessibilityOption->id;
            }
        }
        $attendee->accessibilityOptions()->sync($accessibilityOptions);
        $attendee->save();
    }



}
