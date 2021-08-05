<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class AttendeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return true;

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
            /* Disabled until "other" functionality is implemented.
            'recip_access_other' =>'required_in:recip_access_checkbox,Other|max:255',
            'guest_access_other' => 'required_in:guest_access_checkbox,Other|max:255',
            'recip_diet_other' => 'required_in:recip_diet_checkbox,Other|max:255',
            'guest_diet_other' => 'required_in:guest_diet_checkbox,Other|max:255',
            */
            // Contact Info
            'office_address_street_address' => 'required_if:rsvp,false',
            'office_address_community_id'   => 'required_if:rsvp,false',
            'office_address_postal_code'    => 'required_if:rsvp,false',
            // Retirement
            'retirement_status'             => 'required',
            'retirement_date'               => 'required_if:retirement_status,true',
            // Preferred contact
            // Multiple ways to require this - but also check validity of format.
            'home_email'                    => 'required_if:retirement_status,true|required_if:contact_update,true',
            'office_email'                  => 'required_if:contact_update,true',
            'home_phone'                    => 'required_if:contact_update,true',
            'office_phone'                  => 'required_if:contact_update,true',
            'preferred_contact'             => 'required_if:contact_update,true',

        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            //
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // Clearer messages so that the user has a better indication of what is wrong.
            //** RECIPIENT **/
            // Recip access considerations.
            'access_group_recip.required_if' => 'Please indicate if you require accessibility considerations.',
            // Recipient choices.
            'recip_access_other.required_in' => 'Please let us know what accessibility considerations you have.',
            'recip_access_checkbox.required_if' => 'Please choose at least one accessibility consideration.',
            // Recip diet considerations.
            'recipient_diet.required_if' => 'Please indicate if you require dietary considerations.',
            // Recip diet choices.
            'recip_diet_checkbox.required_if' => 'Please choose at least one dietary requirement.',
            'recip_diet_other.required_in' => 'Please fill out the box above to let us know what diet considerations you have.',

            //** GUEST **/
            // Guest considerations.
            'guest.required_if' => 'Please indicate if you will bring a guest.',
            // Guest access.
            'guest_access.required_if' => 'Please indicate if your guest requires accessibility considerations.',
            // Guest access choices.
            'guest_access_checkbox.required_if' => 'Please choose at least one accessibility consideration.',
            'guest_access_other.required_in' => 'Please fill out the box above to let us know what accessibility considerations you have.',
            // Guest diet.
            'guest_diet.required_if' => 'Please indicate if your guest has dietary requirements.',
            // Guest diet choices.
            'guest_diet_checkbox.required_if' => 'Please choose at least one dietary consideration.',
            'guest_diet_other.required_in' => 'Please fill out the box above to let us know what diet considerations you have.',

            //** CONTACT RULES  **/
            // Gift location - RSVP must be false (radio)
            'office_address_street_address.required_if' => 'Please enter an address.',
            'office_address_postal_code.required_if' => 'Please enter a valid postal code.',
            //'gift_location_postal.postal_code' => 'Please enter a valid postal code.',
            'office_address_community_id.required_if' => 'Please select a community.',

            // Preferred contact
            'home_email.required_if' => 'Please input your home email address.',
            'home_email.email' => 'Please enter a valid home email address in the format emailaddress@provider.com.',
            'office_email.required_if' => 'Please enter your office email address.',
            'office_email.email' => 'Please enter a valid office email address in the format emailaddress@provider.com.',
            'office_phone.required_if' => 'Please enter an office phone number',
            'office_phone.phone' => 'Please enter a valid Canadian office phone number in the format 555-555-5555',
            'home_phone.required_if' => 'Please enter a home phone number',
            'home_phone.phone' => 'Please enter a valid Canadian home phone number in the format 555-555-5555',
            'prefer_contact.required_if' => 'Please indicate how you would prefer we contact you.',
            // Retirement date
            'retirement_date.required_if' => 'Please indicate when you will be retiring.'
        ];
    }
}
