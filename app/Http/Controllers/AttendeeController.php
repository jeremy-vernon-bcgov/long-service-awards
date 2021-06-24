<?php

namespace App\Http\Controllers;

use App\Models\AccessibilityOption;
use App\Models\AccessibilityOptionAttendee;
use App\Models\Community;
use App\Models\DietaryRestriction;
use App\Models\DietaryRestrictionAttendee;
use App\Models\Guest;
use App\Models\Recipient;
use DateTime;
use Illuminate\Http\Request;
use App\Models\Attendee;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class AttendeeController extends Controller
{
    /**
     * @param int $aid The attendee id as passed through the URL.
     * @return array|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|null
     * @throws \Exception
     */
    public function rsvpBuild(int $aid)
    {
        // Get the recipient record, and related data.
        $data = (new Attendee)->getByRecipientId($aid);
        // Check if user should be allowed to RSVP
        if($data->status === 'invited') {
            // Grab list of dietary options
            $diet = DietaryRestriction::all('short_name');
            $data->diet = $diet;
            // Grab list of accessibiltiy options.
            $access = AccessibilityOption::all('short_name', 'description');
            $data->access = $access;

            // Grab all communities.
            $communities = Community::all('id', 'name');
            $data->communities = $communities;

            // Push our id's to Session so we can use them when saving post data.
            Session::put('aid', $aid);

            // Need a specific datetime format here.
            $data->scheduled_datetime = new DateTime($data->scheduled_datetime);
            return view('rsvp.rsvp')->with('data', $data);
        }
        // TODO: Handle error here
        return null;
    }

    /**
     * RSVP reply.
     * @param Request $request
     * @return mixed
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function collectRsvp(Request $request) {
        /**
         * Validation.
         */
        // Set up rules.
        $rules = [
            // Required fields
            'rsvp' => 'required',
            'guest' => 'required_if:rsvp,true',

            // If they are attending, we need to know if they have disability or accessibility needs.
            'access_group_recip' => 'required_if:rsvp,true',
            'recipient_diet' => 'required_if:rsvp,true',

            // If they have a guest, we need to know if their guest has disability or accessibility needs.
            'guest_access' => 'required_if:guest,true',
            'guest_diet' => 'required_if:guest,true',

            // If they note "other" they must give specifics.
            'recip_access_other' =>'required_with:recip_access_checkbox,Other|max:255',
            'guest_access_other' => 'required_with:guest_access_checkbox,Other|max:255',
            'recip_diet_other' => 'required_with:recip_diet_checkbox,Other|max:255',
            'guest_diet_other' => 'required_with:guest_diet_checkbox,Other|max:255',
            // If they note they have accessibility/diet requirements, they must choose at least one.
            'recip_access_checkbox' => 'required_if:access_group_recip,true',
            'guest_access_checkbox' => 'required_if:guest_access,true',
            'recip_diet_checkbox' => 'required_if:recipient_diet,true',
            'guest_diet_checkbox' => 'required_if:guest_diet,true',
            // Contact Info
            'gift_location_addr' => 'required_if:rsvp,false',
            'gift_location_postal' => 'required_if:rsvp,false|postal_code:CA',
            'gift_location_community' => 'required_if:rsvp,false',
            // Retirement
            'retirement_status' => 'required',
            'retirement_date' => 'required_if:retirement_status,true',
            // Preferred contact
            // Multiple ways to require this - but also check validity of format.
            'home_email' => 'required_if:rsvp,false|required_if:retirement_status,true|required_if:contact_update,true|email',
            'office_email' => 'required_if:rsvp,false|required_if:contact_update,true|email',
            'preferred_phone' => 'required_if:rsvp,false|required_if:retirement_status,true|required_if:contact_update,true|phone:CA',
            'prefer_contact' => 'required_if:rsvp,false|required_if:contact_update,true'
        ];

        // Custom error messages.
        $messages = [
            // Clearer messages so that the user has a better indication of what is wrong.
            //** RECIPIENT **/
            // Recip access considerations.
            'access_group_recip.required_if' => 'Please indicate if you require accessibility considerations.',
            // Recipient choices.
            'recip_access_other.required_with' => 'Please fill out the box above to let us know what accessibility considerations you have.',
            'recip_access_checkbox.required_if' => 'Please choose at least one accessibility consideration.',
            // Recip diet considerations.
            'recipient_diet.required_if' => 'Please indicate if you require dietary considerations.',
            // Recip diet choices.
            'recip_diet_checkbox.required_if' => 'Please choose at least one on dietary requirement.',
            'recip_diet_other.required_with' => 'Please fill out the box above to let us know what diet considerations you have.',

            //** GUEST **/
            // Guest considerations.
            'guest.required_if' => 'Please indicate if you will bring a guest.',
            // Guest access.
            'guest_access.required_if' => 'Please indicate if your guest requires accessibility considerations.',
            // Guest access choices.
            'guest_access_checkbox.required_if' => 'Please choose at least one accessibility consideration.',
            'guest_access_other.required_with' => 'Please fill out the box above to let us know what accessibility considerations you have.',
            // Guest diet.
            'guest_diet.required_if' => 'Please indicate if your guest requires dietary considerations.',
            // Guest diet choices.
            'guest_diet_checkbox.required_if' => 'Please choose at least one dietary consideration.',
            'guest_diet_other.required_with' => 'Please fill out the box above to let us know what diet considerations you have.',

            //** CONTACT RULES  **/
            // Gift location - RSVP must be false (radio)
            'gift_location_addr.required_if' => 'Please enter an address.',
            'gift_location_postal.required_if' => 'Please enter a valid postal code.',
            'gift_location_postal.postal_code' => 'Please enter a valid postal code.',
            'gift_location_community.required_if' => 'Please select a community.',

            // Preferred contact
            'home_email.required_if' => 'Please input your preferred email address.',
            'home_email.email' => 'Please enter a valid email address.',
            'office_email.required_if' => 'Please input your preferred email address.',
            'office_email.email' => 'Please enter a valid email address.',
            'preferred_phone.required_if' => 'Please input your preferred phone address.',
            'preferred_phone.phone' => 'Please enter a valid Canadian phone number.',
            'prefer_contact.required_if' => 'Please indicate which email you would prefer us to contact.',
            // Retirement date
            'retirement_date.required_if' => 'Please indicate when you will be retiring.'
        ];
        // Send to validator.
        $this->validate($request, $rules, $messages);
        /**
         * Parse Post data if it passes validation.
         */
        //Original attendee record from session.
        $id = Session::get('aid');
        // Get Attendee record
        $attendee = Attendee::find($id);
        if($attendee === null){
            // Try to get attendee from recipient_id
            $attendee = Attendee::where('recipient_id', $request->recipient_id);
            // TODO: if we still can't find them, then we need to eject and throw an error.
        }

        // Update or add $guest record.
        if($request->guest) {
            // Return guest_id after
            $guest_id = $this->guestManagement($attendee, $request);
        } else {
            $guest_id = null;
        }

        // Could be any number of diet requests - so we need to check them one by one to see if they should be updated or inserted.
        if($request->recip_diet_checkbox) {
            $rd_other = $request->recip_diet_other ?? null;
            $this->updateDietaryRecords($id, $request->recip_diet_checkbox, $rd_other);
        }
        // Guest dietary request
        if($guest_id !== null && isset($request->guest_diet_checkbox)) {
            $gd_other = $request->guest_diet_other ?? null;
            $this->updateDietaryRecords($guest_id, $request->guest_diet_checkbox, $gd_other);
        }

        // Update/add accessibility records.
        if($request->recip_access_checkbox) {
            $ra_other = $request->recip_access_other ?? null;
            $this->updateAccessibilityRecords($id, $request->recip_access_checkbox, $ra_other);
        }
        // Guest accessibility record.
        if($guest_id !== null && isset($request->guest_access_checkbox)){
            $ga_other = $request->guest_access_other ?? null;
            $this->updateAccessibilityRecords($guest_id, $request->guest_access_checkbox, $ga_other);
        }

        // Update RSVP status
        $rsvp =  $request->rsvp;
        if($rsvp) {
            $attendee->status = 'attending';
        } else {
            $attendee->status = 'declined';
        }
        // Update guest info
        if($guest_id !== null) {
            $attendee->guest_id = $guest_id;
        }
        // Updates to Recipient record.
        $update_status = $this->recipientUpdate($request, $attendee);
        // Recipient has been successfully saved.
        if($update_status){
            // Todo: Log
        } else {
            // Todo: throw error.
        }
        // Save the attendee status
        $attendee_status = $attendee->save();
        if($attendee_status){
            // Todo: Log and call for close.
            // TODO: Set return message.
        }

        // TODO: redirect to confirmation page.
        return $request->input();
    }

    /**
     * Helper function to update dietary requirements for an attendee or guest.
     *
     * @param int $id - either the recip or guest id
     * @param array $choices - The users accessibility choice(s).
     */
    private function updateDietaryRecords($id, $choices, $other=null) {
        // Get all possible dietary choices and their ids
        // Check if user has previous record
        $dietary_prev = DietaryRestrictionAttendee::where('attendee_id', $id)->first();

        if($dietary_prev !== null) {
            //TODO: Remove previous records
        }
        $dietary_choices = DietaryRestriction::pluck('id', 'short_name')->toArray();
        foreach($choices as $key=>$value){
            // We need to remove the addition to the data
            // Get dietary id for user choice.
            if(array_key_exists($value, $dietary_choices)){
                $diet_id = $dietary_choices[$value];
            } else {
                //TODO handle error
                continue;
            }
            // Don't need to do anything if we already have this - just insert.
            $diet_record = new DietaryRestrictionAttendee;
            $diet_record->attendee_id = $id;
            $diet_record->dietary_restriction_id = $diet_id;
            if($other !== null){
                $diet_record->additional_details = $other;
            }
            // Todo - if option is other, we need to get that data.
            $diet_record->save();
        }
    }

    /**
     * Helper function to update accessibility requirements for an attendee or guest.
     *
     * @param int $id - either the recipient or guest id
     * @param array $choices - The users accessibility choice(s).
     */
    private function updateAccessibilityRecords($id, $choices, $other = null) {
        // Get all possible dietary choices and their ids
        // Check if user has previous record
        $recip_prev = AccessibilityOptionAttendee::where('attendee_id', $id)->first();

        if($recip_prev !== null) {
            //TODO: Remove previous records
        }
        $access_requirements = AccessibilityOption::pluck('id', 'short_name')->toArray();
        foreach($choices as $key=>$value){
            // Get dietary id for user choice.
            if(array_key_exists($value, $access_requirements)){
                $access_id = $access_requirements[$value];
            } else {
                //TODO handle error
                continue;
            }
            // Don't need to do anything if we already have this - just insert.
            $access_record = new AccessibilityOptionAttendee();
            $access_record->attendee_id = $id;
            $access_record->accessibility_option_id = $access_id;
            // If option is other, we need to get that data.
            if($other !== null){
                $access_record->additional_details = $other;
            }

            $access_record->save();
        }
    }

    /**
     * Helper function to update or create a new guest record.
     *
     * @param $attendee
     * @param $request
     * @return mixed|null
     */
    private function guestManagement($attendee, $request) {
        $guest = Guest::find($attendee->guest_id);
        if($guest === null) {
            $guest = new Guest;
        }

        $guest->recipient_id = $attendee->recipient_id;
        $saved = $guest->save();

        if($saved){
            // Get id of new guest record.
            $guest_id = $guest->id;
        } else {
            // TODO: Error handling
            $guest_id = null;
        }
        // We also need update or add a guest attendee record
        $this->guestAttendee($attendee, $guest_id);

        return $guest_id;
    }

    /**
     * Helper function to add or update an existing guest attendee record.
     *
     * @param $attendee
     * @param $guest_id
     */
    private function guestAttendee($attendee, $guest_id)
    {
        // This is a guest record - we need to see if they exist yet.
        $guest_attendee = Attendee::where([
            'guest_id' => $guest_id,
            'type' => 'guest',
        ])->first();
        if ($guest_attendee === null) {
            // This is a new record
            $guest_attendee = new Attendee;
        }
        $guest_attendee->type = 'guest';
        $guest_attendee->guest_id = $guest_id;
        // Require carry over recipient data.
        $guest_attendee->recipient_id = $attendee->recipient_id;
        $guest_attendee->ceremony_id = $attendee->ceremony_id;
        $guest_attendee->status = 'attending';
        $guest_attendee->save();
    }

    /**
     * Helper function to update recipient contact info if required.
     *
     * @param $request
     * @param $attendee
     * @return mixed
     */
    private function recipientUpdate($request, $attendee) {
        $recipient = Recipient::find($attendee->recipient_id);
        // Update retirement status
        $request->retirement_status === 'true' ? $recipient->retiring_this_year = 1 : $recipient->retiring_this_year = 0;
        // Update address if user is not attending, and are not retiring.
        if(isset($request->rsvp, $request->retirement_status) && $request->rsvp === 'false' && $request->retirement_status === 'false') {
            isset($request->gift_location_floor) ? $recipient->office_address_prefix = $request->gift_location_floor : $recipient->office_address_prefix = ''; // We need to blank this out if it has changed. Not required in form.
            // sic - this is misspelled in the db (suit instead of suite). If this is updated in db, we will need to update it here as well.
            isset($request->gift_location_suit) ? $recipient->office_address_suite = $request->gift_location_suit : $recipient->office_address_suite = ''; // We need to blank this out if it has changed. Not required in form.
            $recipient->office_address_street_address = $request->gift_location_addr; // Required in form.
            $recipient->office_address_postal_code = $request->gift_location_postal; // Required in form.
            $recipient->office_address_community_id = $request->gift_location_community; // Required in form.
        }
        // Handle emails and phone.
        if(isset($request->office_email)) {
            $recipient->government_email = $request->office_email;
            // Users can set one email to their preferred contact method.
            if (isset($request->prefer_contact) && $request->prefer_contact === "office") {
                $recipient->preferred_email = $request->office_email;
            }
        }
        // Users can set one email to their preferred contact method.
        if(isset($request->home_email)) {
            $recipient->personal_email = $request->home_email;
            if (isset($request->prefer_contact) && $request->prefer_contact === "home") {
                $recipient->preferred_email = $request->home_email;
            }
        }
        if(isset($request->preferred_phone)) {
            $recipient->government_phone_number = $request->preferred_phone;
        }
        return $recipient->save();
    }
}
