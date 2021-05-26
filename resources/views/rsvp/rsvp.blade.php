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
        status: The status of the recipient (invited, assigned, attend, declined, waitlisted.
--}}
<h1 >
    RSVP
</h1>
<div >
    <div >
        <h1> <strong> Hello {{$data->first_name . ' ' . $data->last_name }} </strong></h1>
        <div>
            <h2>Inclusivity</h2>
            <p>The Long Service Awards ceremonies are welcoming and accessible events.</p>
            <p>Government House has gender-neutral washroom facilities. Check the Venue Accessibility page for specific locations or contact [EMAIL] with questions.</p>
        </div>
        <div>
            <h2>Accessibility Requirements</h2>
            <p>To ensure you and your guest are able to enjoy the festivities, please share your accessibility requirements with us.</p>
            <p>If you’d like a preview of accessible facilities at Government House including ramps, elevators and washroom facilities, visit the Venue Accessibility page. If you have questions or wish to connect with a member of the Long Service Awards team directly, contact [EMAIL?].</p>
        </div>

        <form action="/rsvp" method="POST">
            @csrf
            <input type="checkbox" name="rsvp" />
            <label class="block font-medium text-sm text-gray-700">I will be attending the LSA ceremonies.</label><br /><br />

            <input type="checkbox" name="guest"  />
            <label class="block font-medium text-sm text-gray-700"> A guest be attending with me.</label><br /><br />

            <input type="text" name="guest_first_name" placeholder="Enter guests first name" /><br /><br />
            <input type="text" name="guest_last_name" placeholder="Enter guests last name" /><br /> <br />

            <fieldset class="form-group" name="diet-group" id="accessible_form_recipient">
                <label>Dietary Restrictions for Recipient</label><br /><br />
                {{-- Add in all dietary restrictions in foreach --}}
                @foreach($data->access as $access )
                    <input type="checkbox" name="access_checkbox[]" value="{{$access->short_name}}_recipient"  />
                    <label class="block font-medium text-sm text-gray-700"> {{$access->short_name}}</label><br />
                @endforeach
            </fieldset>
            <x-button class="ml-3">
                {{ __('Submit') }}
            </x-button>

        </form>
    </div>
</div>
@endsection('content')
