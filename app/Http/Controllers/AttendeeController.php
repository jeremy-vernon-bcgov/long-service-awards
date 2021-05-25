<?php

namespace App\Http\Controllers;

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
        print_r('<pre>' . $attendee . '</pre>');
        die();
        // TODO: Check if user has previously RSVP'd
        //if($attendee->get('status') == 'invited') {

        //} else {
            // Handle an error here.
        //}
        return view('rsvp.rsvp')->with('data', $attendee);
    }

    /**
     * RSVP reply.
     * @param Request $request
     */
    protected function collectRsvp(Request $request) {

        // TODO: $request-> rsvp will change status
        $attendee = new Attendee();
        $attendee->rsvp = $request->rsvp;
        $attendee->guest = $request->guest;
        // TODO: $request->guest_first_name will change guest->first name
        $attendee->guest_name = $request->guest_name;
        // TODO: $request ->guest_last_name will change guest->last name
        // Save the attendee status
        $attendee->save();
        return $request->input();
        // TODO: Return confirmation and call for close.
    }

}
