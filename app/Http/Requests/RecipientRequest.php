<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;
use Illuminate\Foundation\Http\FormRequest;

class RecipientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // only allow updates if the user is logged in
        return backpack_auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //Identifying Information
            'idir'                 => 'min:2|max:255',
            'guid'                 => 'min:2|max:255',
            'employee_number'      => 'required|alpha_num|min:3|max:16',
            'first_name'           => 'required|min:2|max:255',
            'last_name'            => 'required|min:2|max:255',
            'is_bcgeu_member'      => 'boolean',

            //Milestone Information
            'milestone'            => 'required|numeric|in:25,30,35,40,45,50',
            'milestone_year'       => 'required|numeric|in:2016,2017,2018,2019,2020,2021',
            'retiring_this_year'   => 'boolean',
            'retirement_date'      => 'date',
            'survey_participation' => 'boolean',

            //Work Contact Information
            'government_email'          => 'required|email',
            'government_phone_number'   => 'required|regex:^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$',
            'branch_name'               => 'require|min:3|max:255',
            'office_prefix'             => 'max:255',
            'office_suite'              => 'max:255',
            'office_street_address'     => 'required|min:5|max:255',
            'office_postal_code'        => 'required|min:7|max:7',
            'office_community'          => 'required|exists:communities',


            //Personal Contact Information
            'personal_email'            => 'email',
            'personal_phone_number'     => 'regex:^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$',
            'personal_prefix'           => 'max:255',
            'personal_suite'            => 'max:255',
            'personal_street_address'   => 'required|min:5|max:255',
            'personal_postal_code'      => 'required|min:7|max:7',
            'personal_community'        => 'required|exists:communities',

            //Supervisor Information
            'supervisor_first_name'     => 'required|min:2|max:255',
            'supervisor_last_name'      => 'required|min:2|max:255',
            'supervisor_email'          => 'required|email',
            'supervisor_prefix'         => 'max:255',
            'supervisor_suite'          => 'max:255',
            'supervisor_street_address' => 'required|min:5|max:255',
            'supervisor_postal_code'    => 'required|exists:communities',

            //Administrivia
            'registered_in_2019'        => 'boolean',
            'award_received'            => 'boolean',
            'milestone_20_certificate_name' => 'min:2|max:255',
            'milestone_20_certificate_ordered' => 'boolean',
            'is_retroactive'            => 'boolean',
            'noshow_at_ceremony'        => 'boolean',
            'presentation_number'       => 'integer',
            'executive_recipient'       => 'boolean',
            'recipient_speaker'         => 'boolean',
            'reserved_seating'          => 'boolean',








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
            //
        ];
    }
}
