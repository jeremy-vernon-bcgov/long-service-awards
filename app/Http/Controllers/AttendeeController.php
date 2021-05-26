<?php

namespace App\Http\Controllers;

use App\Models\AccessibilityOption;
use App\Models\AccessibilityOptionAttendee;
use App\Models\DietaryRestriction;
use App\Models\DietaryRestrictionAttendee;
use App\Models\Guest;
use App\Models\Recipient;
use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Void_;

class AttendeeController extends Controller
{
    /**
     * RSVP form builder.
     */
    public function rsvpBuild(int $id)
    {
        // Get the recipient record.
        $attendee = (new Attendee)->getByRecipientId($id);
        // Check if user should be allowed to RSVP
        if($attendee->status === 'invited') {
            // Grab list of dietary options
            $diet = DietaryRestriction::all('short_name');
            $attendee->diet = $diet;
            // Grab list of accessibiltiy options.
            $access = AccessibilityOption::all('short_name');
            $attendee->access = $access;
            // Push our id's to Session so we can use them when saving post data.
            Session::put('aid', $id);

            return view('rsvp.rsvp')->with('data', $attendee);
        }
        // TODO: Handle error here
        return null;
    }

    /**
     * RSVP reply.
     * @param Request $request
     */
    protected function collectRsvp(Request $request) {
        // Validation first
        // If they are bringing a guest, we need their guest names.
        if($request->guest == 'on' ) {
            $this->validate($request, [
                'rsvp' => 'required',
                'guest_first_name'=>'required',
                'guest_last_name'=>'required',
            ]);
        } else {
            // No guest.
            $this->validate($request, [
                'rsvp' => 'required',
            ]);
        }

        // Get Attendee record
        $attendee = Attendee::find(Session::get('aid'));
        if($attendee === null){
            // Try to get attendee from recipient_id
            $attendee = Attendee::where('recipient_id', $request->recipient_id);
            // TODO: handle error
        }
        // Update or add $guest record.
        $guest = Guest::find($attendee->guest_id);
        if($guest === null) {
            $guest = new Guest;
        }
        $guest->first_name = $request->guest_first_name;
        $guest->last_name = $request->guest_last_name;
        $guest->recipient_id = $attendee->recipient_id;
        $saved = $guest->save();
        if($saved){
            // Get id of new guest record.
            $guest_id = $guest->id;
        } else {
            // TODO: Error handling
        }

        // Update/add Dietary record.
        $diet = DietaryRestrictionAttendee::where('attendee_id', $attendee->id);
        if($diet === null){
            $diet = new DietaryRestrictionAttendee;
        }
        // Get and store anything that is not already there.


        // Update/add accessibility record.
        $access = AccessibilityOptionAttendee::where('attendee_id', $attendee->id);
        if($access === null){
            $access = new AccessibilityOptionAttendee;
        }

        // TODO: Update Attendee record
        // Update RSVP status
        $rsvp =  $request->rsvp;
        if($rsvp) {
            $attendee->status = 'attending';
        } else {
            $attendee->status = 'declined';
        }
        // Update guest info
        $attendee->guest_id = $guest_id;
        // Save the attendee status
        //$attendee->save();
        // TODO: Return confirmation and call for close.

        return $request->input();
    }



}
