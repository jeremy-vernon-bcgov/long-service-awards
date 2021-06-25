@extends('layouts.admin')

@section('content')
{{--
    Data: Object containing following values
        id: The attendee id.
        first_name: The first name of the recipient
        last_name: The last name of the recipient
        recipient_id: The recipients id
        type: The type of recipient this is (vip/exec etc.)
        guest_id: The id of the guest if the user already has one.
        ceremony_id: The id of the ceremony the user has been invited to.
        access: The accesibility options pulled from the database.
        diet: The dietary options pulled from the database.

--}}
<div id="app" > <!-- for app.js vue -->
    <div >
        {{------------------------
         Pre-amble
        -------------------}}
        <div id="preamble">
            {{-- Customized opening --}}
            <div id="rsvp-custom">
                <p> The Province of British Columbia is pleased to invite</p>
                <p>{{$data->first_name . ' ' . $data->last_name }} </p>
                <p>to the Long Service Awards Ceremony on </p>
                <p>{{ date_format($data->scheduled_datetime, 'l, F j') }} at {{ date_format($data->scheduled_datetime, 'g:i a') }} </p>
                <p>at Government House</p>
                <p>1401 Rockland Ave,</p>
                <p>Victoria, British Columbia</p>
            </div>
            <div id="rsvp-column">
                <p>This invitation is for the intended recipient and one guest.</p>
                <p>Doors open at 5:45pm.</p>
                <p>Dress: Business casual</p>
            </div>
        </div>
        {{-----------------------
          Form start - RSVP component
         ----------------------}}
        <rsvp :userData='@json($data)'></rsvp>
    </div>
</div>
@endsection
