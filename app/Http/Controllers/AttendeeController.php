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

    public function rsvpBuild(int $rid)
    {


        $data['recipient'] = Recipient::find($rid);
        //Removed requirement for 'invited' status for testing purposes!! PUT BACK IN PRODUCTION

        if (!empty($data['recipient']->attendee)):
       // if (!empty($data['recipient']->attendee->status) && $data['recipient']->attendee->status === 'invited') :
            $data['diet']           = DietaryRestriction::all('short_name');
            $data['access']         = AccessibilityOption::all('short_name', 'description');
            $data['communities']    = Community::all('id','name');
            $data['rid']            = $rid;
            $data['jsonBundle']['diet'] = $data['diet'];
            $data['jsonBundle']['access'] = $data['access'];
            $data['jsonBundle']['communities'] = $data['communities'];
            $data['jsonBundle']['csrftoken'] = csrf_token();

            //RSVP form requires a specific datetime format.


            $data['scheduled_datetime'] = new DateTime($data['recipient']->attendee->ceremony->scheduled_datetime);
            return view('rsvp.rsvp-plain', $data);
        endif;
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

            //TODO HANDLE OFFICE ADDRESS UPDATES

        endif;

        if (!empty($request->contact_update) && $request->contact_update === 'true') :
            $updateParams = [
                'office_phone',
                'home_phone',
                'office_email',
                'home_email',
                'preferred_contact',
            ];
            foreach ($updateParams as $param) :
                $this->checkAndUpdate($param, $request, $recipient);
            endforeach;
                $data['updated_contact'] = true;
            else:
                $data['updated_contact'] = false;
        endif; //end contact update


        $recipient->attendee->save();
        $recipient->save();
        $data['recipient'] = $recipient;
        return view('rsvp.confirmation', $data);
    }

    private function checkAndUpdate($param, $request, $recipient) {
        if (!empty($request->$param)) {
            $recipient->$param = $request->$param;
        }
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
