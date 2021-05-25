<?php

namespace App\Http\Controllers;

use App\Models\Guest;
use Illuminate\Http\Request;
use App\Models\Attendee;
use App\Models\Recipient;

class AttendeeController extends Controller
{
    /**
     * RSVP form builder.
     */
    public function rsvpBuild(Request $request)
    {
        // Get the query string to id the invite recipient.
        $id = $request->query('id', 'none');
        // Get the recipient record.
        $attendee = (new Attendee)->getByRecipientId($id);

        // TODO: Check if user has previously RSVP'd
        if($attendee->status == 'invited') {
            return view('rsvp.rsvp')->with('data', $attendee);
        }
        // TODO: Handle error here
        return view('rsvp.rsvp')->with('data', $attendee);
    }

    /**
     * RSVP reply.
     * @param Request $request
     */
    protected function collectRsvp(Request $request) {

        // TODO: $request-> rsvp will change status
        // TODO: To update Attendee record
        $attendee = new Attendee();
        // TODO: add $guest record
        $guest = new Guest();
        // TODO: update/add Dietary record.

        // TODO: update/add accessibility record.

        $attendee->rsvp = $request->rsvp;
        $attendee->guest = $request->guest;
        // TODO: $request->guest_first_name will change guest->first name
        $attendee->guest_first_name = $request->guest_first_name;
        // TODO: $request ->guest_last_name will change guest->last name
        $attendee->guest_last_name = $request->guest_first_name;

        // Save the attendee status
        $attendee->save();
        return $request->input();
        // TODO: Return confirmation and call for close.
    }

}
