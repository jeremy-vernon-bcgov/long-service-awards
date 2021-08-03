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
            'recip_access_other' =>'required_in:recip_access_checkbox,Other|max:255',
            'guest_access_other' => 'required_in:guest_access_checkbox,Other|max:255',
            'recip_diet_other' => 'required_in:recip_diet_checkbox,Other|max:255',
            'guest_diet_other' => 'required_in:guest_diet_checkbox,Other|max:255',
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
            'recip_access_other.required_in' => 'Please fill out the box above to let us know what accessibility considerations you have.',
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
            'guest_diet.required_if' => 'Please indicate if your guest requires dietary considerations.',
            // Guest diet choices.
            'guest_diet_checkbox.required_if' => 'Please choose at least one dietary consideration.',
            'guest_diet_other.required_in' => 'Please fill out the box above to let us know what diet considerations you have.',

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
    }
}
