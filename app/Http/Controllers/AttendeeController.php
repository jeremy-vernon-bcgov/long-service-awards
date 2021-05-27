<?php

namespace App\Http\Controllers;

use App\Models\AccessibilityOption;
use App\Models\AccessibilityOptionAttendee;
use App\Models\DietaryRestriction;
use App\Models\DietaryRestrictionAttendee;
use App\Models\Guest;
use App\Models\Recipient;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
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
        $validator = Validator::make($request->all(), [
            'rsvp' => 'required',
            'guest_first_name'=>'required_if:guest,on',
            'guest_last_name'=>'required_if:guest,on',
        ], $messages = [
            'required_if' => 'The :attribute field is required if have indicate you will have a guest.',
        ]);
        if($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        //Original attendee record from path.
        $id = Session::get('aid');
        // Get Attendee record
        $attendee = Attendee::find($id);
        if($attendee === null){
            // Try to get attendee from recipient_id
            $attendee = Attendee::where('recipient_id', $request->recipient_id);
            // TODO: if we still can't find them, then we need to eject and throw an error.
        }
        // Update or add $guest record.
        if(isset($request->guest) && $request->guest == 'on') {
            // TODO: Put all guest logic in a function here.
            // Return guest_id after.
        }
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
            $guest_id = null;
        }
        // TODO: We also need update or add a guest attendee record
        $guest_attendee = Attendee::where([
           'guest_id' => $guest_id,
            'type' => 'guest',
        ]);




        // Could be any number of diet requests - so we need to check them one by one to see if they should be updated or inserted.
        if(isset($request->recip_diet_checkbox)) {
            $this->updateDietaryRecords($id, $request->recip_diet_checkbox);
        }
        // Guest dietary request
        if($guest_id !== null && isset($request->guest_diet_checkbox)) {
            $this->updateDietaryRecords($guest_id, $request->guest_diet_checkbox);
        }

        // Update/add accessibility records.
        if(isset($request->recip_access_checkbox)) {
            $this->updateAccessibilityRecords($id, $request->recip_access_checkbox);
        }
        // Guest accessibility record.
        if($guest_id !== null && isset($request->guest_access_checkbox)){
            $this->updateAccessibilityRecords($guest_id, $request->guest_access_checkbox);
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
        $attendee->save();
        // TODO: Return confirmation and call for close.

        return $request->input();
    }

    /**
     * @param int $id - either the recip or guest id
     * @param array $choices - The users accessibility choice(s).
     */
    private function updateDietaryRecords($id, $choices) {
        // Get all possible dietary choices and their ids
        // Check if user has previous record
        $dietary_prev = DietaryRestrictionAttendee::where('attendee_id', $id);

        if($dietary_prev !== null) {
            //TODO: Remove previous records
        }
        $dietary_choices = DietaryRestriction::pluck('id', 'short_name');
        foreach($choices as $key=>$value){
            // Get dietary id for user choice.
            if(in_array($key, $dietary_choices, false)){
                $diet_id = $value;
            } else {
                //TODO handle error
                continue;
            }
            // Don't need to do anything if we already have this - just insert.
            $diet_record = new DietaryRestrictionAttendee;
            $diet_record->attendee_id = $id;
            $diet_record->dietary_restriction_id = $diet_id();
            $diet_record->save();
        }
    }

    /**
     * @param int $id - either the recipient or guest id
     * @param array $choices - The users accessibility choice(s).
     */
    private function updateAccessibilityRecords($id, $choices) {
        // Get all possible dietary choices and their ids
        // Check if user has previous record
        $recip_prev = AccessibilityOptionAttendee::where('attendee_id', $id);

        if($recip_prev !== null) {
            //TODO: Remove previous records
        }
        $access_requirements = AccessibilityOption::pluck('id', 'short_name');
        foreach($choices as $key=>$value){
            // Get dietary id for user choice.
            if(in_array($key, $access_requirements, false)){
                $access_id = $value;
            } else {
                //TODO handle error
                continue;
            }
            // Don't need to do anything if we already have this - just insert.
            $access_record = new AccessibilityOptionAttendee();
            $access_record->attendee_id = $id;
            $access_record->accessibility_option_id = $access_id();
            $access_record->save();
        }
    }

}
