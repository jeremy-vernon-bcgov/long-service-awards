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

            /* The "do you need" accommodation toggle is not input - it is treated as a way of segmenting the form.*/
            /* Thus, we don't require it to be set and we don't require other inputs if it is */


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
           // 'retirement_status'             => 'required',
            'retirement_date'               => 'required_if:retirement_status,true',
            // Preferred contact
            // Multiple ways to require this - but also check validity of format.
            'personal_email'                    => 'required_if:retirement_status,true|required_if:contact_update,true',
            'personal_phone'                    => 'required_if:retirement_status,true|required_if:contact_update,true',
            'government_email'                  => 'required_if:contact_update,true',

            'government_phone'                  => 'required_if:contact_update,true',
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


            //** CONTACT RULES  **/
            // Gift location - RSVP must be false (radio)
            'office_address_street_address.required_if'     => 'Please enter an address.',
            'office_address_postal_code.required_if'        => 'Please enter a valid postal code.',
            //'gift_location_postal.postal_code'            => 'Please enter a valid postal code.',
            'office_address_community_id.required_if'       => 'Please select a community.',

            // Preferred contact
            'personal_email.required_if'             => 'Please input your home email address.',
            'personal_email.email'                   => 'Please enter a valid home email address in the format emailaddress@provider.com.',
            'office_email.required_if'           => 'Please enter your office email address.',
            'office_email.email'                 => 'Please enter a valid office email address in the format emailaddress@provider.com.',

            'office_phone.required_if'           => 'Please enter an office phone number',
            'office_phone.phone'                 => 'Please enter a valid Canadian office phone number in the format 555-555-5555',
            'personal_phone.required_if'             => 'Please enter a home phone number',
            'personal_phone.phone'                   => 'Please enter a valid Canadian home phone number in the format 555-555-5555',
            'prefer_contact.required_if'         => 'Please indicate how you would prefer we contact you.',
            // Retirement date
            'retirement_date.required_if'        => 'Please indicate when you will be retiring.'
        ];
    }
}
