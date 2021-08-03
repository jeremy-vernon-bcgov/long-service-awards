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
    public function collectRsvp(Request $request) {


        //Get Recipient from Session
        $recipient = Recipient::find($request->recipid);

        //Are they coming?
        if ($request->rsvp === 'true') :
            $this->updateDietaryRecords('recip_', $recipient->attendee, $request);
            $this->updateAccessibilityRecords('recip_', $recipient->attendee, $request);

            //Are they bringing a guest?
            if ($request->guest === 'true') :
                //Create a guest record associated with recipient, and an attendee record for guest.
                $guest = $recipient->guest()->create();
                $guest_attendee = $guest->attendee()->create([
                    ['ceremony_id'] => $recipient->ceremony->id,
                ]);
                if (!empty($request->guest_diet_checkbox)) {
                    $this->updateDietaryRecords('guest_', $guest_attendee, $request->guest_diet_checkbox);
                }
                if (!empty($request->guest_access_checkbox)) {
                    $this->updateAccessibilityRecords('guest_', $guest_attendee, $request->guest_access_checkbox);
                }
            endif;

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
        endif; //end contact update


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
    private function updateDietaryRecords(String $prefix ,Attendee $attendee,  $choices)
    {

        //Reset dietary restrictions on attendee


        $dietaryRestrictions = [];

        foreach(DietaryRestriction::all() as $restrictionOption)
        {
            $formfield = $prefix . $restrictionOption->short_name;
            if (!empty($request->$formfield) && $request->$formfield === 'true') {
                $dietaryRestrictions[] = $restrictionOption->id;
            }
        }
        $attendee->dietaryRestrictions()->sync($dietaryRestrictions);
    }

    /**
     * @param Attendee $attendee
     * @param $choices
     */
    private function updateAccessibilityRecords(String $prefix, Attendee $attendee,  $choices)
    {
        //Reset accessibility restrictions on attendee

        $accessibilityOptions = [];

        foreach(AccessibilityOption::all() as $accessibilityOption)
        {
            $formfield = $prefix . $accessibilityOption->short_name;
            if (!empty($request->$formfield) && $request->$formfield === 'true') {
                $accessibilityOptions[] = $accessibilityOption->id;
            }
        }
        $attendee->dietaryRestrictions()->sync($accessibilityOptions);
    }

}
