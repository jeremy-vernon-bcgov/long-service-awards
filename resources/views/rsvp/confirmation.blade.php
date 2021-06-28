{{--
    Data: Array of values we need for the confirmation page.
        - office_prefix (if available)
        - office_suite (if available)
        - office_address
        - office_postal_code
        - office_community
--}}
@extends('layouts.admin')

@section('content')

<div class="confirmation-bundle">
    {{-- User declined. --}}
    @if($data['status'] === 'declined')
        <div class="confirmation-message">
            <p>Following the ceremonies in October, your award will be mailed to: </p>
        </div>
        <div class="confirmation-address">
            <p>
                @if($data['office_prefix'])
                    {{ $data['office_prefix'] }},
                @endif
                @if($data['office_suite'])
                    {{ $data['office_suite'] }},
                @endif
                    {{ $data['office_address'] }},
                    {{ $data['office_postal_code'] }},
                    {{ $data['office_community'] }},
            </p>
            <div class="confirmation-message">
                <p>Your Long Service Awards contact will arrange for it to be presented to you.</p>
                <p>If you have any questions, please check our <a href="https://longserviceawards.gww.gov.bc.ca/" target="_blank">website</a>, connect with your <a href="https://longserviceawards.gww.gov.bc.ca/contacts/" target="_blank">workplace Long Service Award contact</a> or <a href="mailto:LongServiceAwards@gov.bc.ca ">email the Long Service Awards team</a>.</p>
            </div>

        </div>
    {{-- User accepts --}}
    @else
        <div class="confirmation-message">
            <p>The ceremony will take place at Government House, and business attire is recommended. Doors open at 5:45 p.m. Your invitation is not required for entry to the ceremony. Doors open at 5:45 p.m. Your invitation is not required for entry to the ceremony.</p>
            <p>Visit the <a href="https://longserviceawards.gww.gov.bc.ca/ceremony/" target="_blank">Long Service Awards website</a> for up-to-date ceremony information.</p>
        </div>
        <div class="confirmation-data">
            {{-- TODO: Need to if most of these depending on data. --}}
            <p>Name:</p>
            <p>Ministry:</p>
            <p>Selected award:</p>
            <p>My accessibility requirements are:</p>
            <p>My guests accessibility requirements are:</p>
            <p>My dietary requirements are:</p>
            <p>My guest's dietary requirements are:</p>
            <p> I have updated my contact information: </p> {{-- If retired or if preferred email has been set. --}}
        </div>
        <div class="confirmation message">
            <p>If you need to make changes to your RSVP information or cancel your attendance, please <a href="mailto:LongServiceAwards@gov.bc.ca">email the Long Service Awards</a> team as soon as possible.</p>
            <p>For information about travel reimbursement and taking time off, visit the <a href="https://longserviceawards.gww.gov.bc.ca/" target="_blank">Long Service Awards website</a> or email your <a href="https://longserviceawards.gww.gov.bc.ca/contacts/" target="_blank">workplace contact</a>. If you have questions about the ceremony, <a href="mailto:LongServiceAwards@gov.bc.ca">email the Long Service Awards team</a>.</p>
        </div>

    @endif

    {{-- User accepted. --}}

</div>
@endsection
