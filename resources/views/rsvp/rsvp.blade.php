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

        <form action="/rsvp" method="POST">
            @csrf
            {{-- RSVP acknowledgement --}}
            <div class="form-group">
                <label class="radio-inline">
                    <input type="radio" name="rsvp" id="rsvp" value="true" required> I will be attending the LSA ceremonies</label><br />
                <label class="radio-inline">
                    <input type="radio" name="rsvp" id="rsvp" value="false" required> I will not be attending the LSA ceremonies</label><br /><br />
                <!-- Error -->
                @if ($errors->has('rsvp'))
                    <div class="error">
                        {{ $errors->first('rsvp') }}
                    </div>
                @endif
            </div>
            <div class="form-group">
                <input type="checkbox" name="guest" id="guest-rsvp" />
                <label class="block font-medium text-sm text-gray-700"> A guest be attending with me.</label><br /><br />
                <!-- Error -->
                @if ($errors->has('guest'))
                    <div class="error">
                        {{ $errors->first('guest') }}
                    </div>
                @endif
            </div>
            {{-- Should only show if guest check above is checked --}}
            <div class="form-group">
                <fieldset class="form-group" name="guest_name" id="guest_name_group">
                    <label> Guests First Name</label>
                    <input type="text" name="guest_first_name"  />
                    <!-- Error -->
                    @if ($errors->has('guest_first_name'))
                        <div class="error">
                            {{ $errors->first('guest_first_name') }}
                        </div>
                    @endif
                    <br /><br />
                    <label> Guests Last Name</label>
                    <input type="text" name="guest_last_name"  />
                    <!-- Error -->
                    @if ($errors->has('guest_last_name'))
                        <div class="error">
                            {{ $errors->first('guest_last_name') }}
                        </div>
                    @endif
                    <br /> <br />
                </fieldset>

            </div>
            {{-- Accessibility section --}}
            <div class="form-group">
                <fieldset class="form-group" name="accessibility" id="accessibility_group">
                    <input type="checkbox" name="recipient_access" id="recipient_access" />
                    <label class="block font-medium text-sm text-gray-700">I will require accessibility considerations.</label><br /><br />
                    <input type="checkbox" name="guest_access" id="guest_access" />
                    <label class="block font-medium text-sm text-gray-700">My guest will require accessibility considerations.</label><br /><br />
                    <fieldset class="form-group" name="access-group-recip" id="access_form_recipient">
                        <label>Accessibility Considerations for Recipient</label><br /><br />
                        {{-- Add in all accessibility restrictions in foreach --}}
                        @foreach($data->access as $access )
                            <input type="checkbox" name="recip_access_checkbox[]" value="{{$access->short_name}}_recipient"  />
                            <label class="block font-medium text-sm text-gray-700"> {{$access->short_name}}</label><br />
                        @endforeach
                    </fieldset><br /><br />
                    <fieldset class="form-group" name="access-group-recip" id="accessible_form_guest">
                        <label>Accessibility Considerations for Guests</label><br /><br />
                        {{-- Add in all accessibility restrictions in foreach --}}
                        @foreach($data->access as $access )
                            <input type="checkbox" name="guest_access_checkbox[]" value="{{$access->short_name}}_guest"  />
                            <label class="block font-medium text-sm text-gray-700"> {{$access->short_name}}</label><br />
                        @endforeach
                    </fieldset>
                </fieldset>
            </div><br /><br />


            {{-- Dietary section --}}
            <div class="form-group">
                <fieldset class="form-group" name="dietary" id="dietary_group">
                    <fieldset class="form-group" name="diet-group-recip" id="diet_form_recipient">
                        <input type="checkbox" name="recipient_access" id="recipient_access" />
                        <label class="block font-medium text-sm text-gray-700">I will require dietary considerations.</label><br /><br />
                        <input type="checkbox" name="guest_access" id="guest_access" />
                        <label class="block font-medium text-sm text-gray-700">My guest will require dietary considerations.</label><br /><br />
                        <label>Dietary Considerations for Recipient</label><br /><br />
                        {{-- Add in all dietary restrictions in foreach --}}
                        @foreach($data->diet as $diet )
                            <input type="checkbox" name="recip_diet_checkbox[]" value="{{$diet->short_name}}_recipient"  />
                            <label class="block font-medium text-sm text-gray-700"> {{$diet->short_name}}</label><br />
                        @endforeach
                    </fieldset><br /><br />

                    <fieldset class="form-group" name="access-group-diet" id="diet_form_guest">
                        <label>Dietary Restrictions for Guests</label><br /><br />
                        {{-- Add in all dietary restrictions in foreach --}}
                        @foreach($data->diet as $diet )
                            <input type="checkbox" name="guest_diet_checkbox[]" value="{{$diet->short_name}}_guest"  />
                            <label class="block font-medium text-sm text-gray-700"> {{$diet->short_name}}</label><br />
                        @endforeach
                    </fieldset>
                </fieldset>
            </div>
            <div class="form-group">
                <x-button class="ml-3">
                    {{ __('Submit') }}
                </x-button>
            </div>

        </form>
    </div>
</div>
@endsection('content')
