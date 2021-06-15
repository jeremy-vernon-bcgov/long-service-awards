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
<div >
    <div >
        {{------------------------
         Pre-amble
        -------------------}}
        <div id="preamble">
            {{-- Customized opening --}}
            <div id="rsvp-custome">
                <p> The government of British Columbia is pleased to invite {{$data->first_name . ' ' . $data->last_name }} to the Long Service Awards Ceremony on {{ date_format($data->scheduled_datetime, 'l, F j') }} at {{ date_format($data->scheduled_datetime, 'g:i a') }} at: </p>
            </div>
            <div id="rsvp-address">
                <p>Government House</p>
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
          Form start
         ----------------------}}
        <form action="/rsvp" method="POST">
            @csrf
            {{--
                Initial section - only the following two will be available.
                RSVP - radio
                Guest - radio
            --}}
            {{-- RSVP acknowledgement --}}
            <h3>RSVP</h3>
            <div class="form-group">
                <label class="radio-inline"> Will you attend? <br />
                    <input type="radio" name="rsvp" id="rsvp" value="true" @if(old('rsvp') == "true") checked @endif> yes
                    <input type="radio" name="rsvp" id="rsvp" value="false" @if(old('rsvp') != null && old('rsvp') != "true") checked @endif > no </label><br /><br />
                {{-- Error --}}
                @if ($errors->has('rsvp'))
                    <div class="alert alert-danger">
                        {{ $errors->first('rsvp') }}
                    </div>
                @endif
            </div>
            {{-- Guest section --}}
            <div class="form-group">
                <label type="radio-inline">Will you bring a guest? <br />
                    <input type="radio" name="guest" id="guest-rsvp" value="true" @if(old('guest') == 'true') checked @endif> yes
                    <input type="radio" name="guest" id="guest-rsvp" value="false" @if(old('guest') != null && old('guest') != 'true') checked @endif> no
                </label><br /><br />
                {{-- Error --}}
                @if ($errors->has('guest'))
                    <div class="alert alert-danger">
                        {{ $errors->first('guest') }}
                    </div>
                @endif
            </div>
            {{------------------------
                Accessibility section.
            ------------------------}}
            <div>
                <h3>Inclusivity</h3>
                <p>The Long Service Awards ceremonies are welcoming and accessible events.</p>
                <p>Government House has gender-neutral washroom facilities. Check the Venue Accessibility page for specific locations or contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a> with questions.</p>
            </div>
            {{--
                Recipient Accessibility section.
                    - Recipient accessibility radio.
                    - Recipient accessibility checkbox.
                    - Recipient accessibilty other.
            --}}
            <div>
                <h3>Accessibility Requirements</h3>
                <p>To ensure you and your guest can enjoy the festivities, please share your accessibility requirements with us.</p>
                <p>If you'd like a preview of accessible facilities at Government House including ramps, elevators and washroom facilities, visit the Venue Accessibility page. If you have questions or wish to connect with a member of the Long Service Awards team directly, contact <a href="mailto:LongServiceAwards@gov.bc.ca">LongServiceAwards@gov.bc.ca</a></p>
            </div>
            <div class="form-group">
                <fieldset class="form-group" name="accessibility" id="accessibility_group">
                    <label class="radio-inline"><strong> Do you require accessibility considerations? </strong> <br />
                        <input type="radio" name="access_group_recip" id="access_form_recipient" value="true" @if(old('access_group_recip') == "true") checked @endif> yes
                        <input type="radio" name="access_group_recip" id="access_form_recipient" value="false" @if(old('access_group_recip') != null && old('access_group_recip') != "true") checked @endif> no

                    </label>
                    @if ($errors->has('access_group_recip'))
                        <div class="alert alert-danger">
                            {{ $errors->first('access_group_recip') }}
                        </div>
                    @endif
                    <br /><br />
                    <fieldset class="form-group" name="access-group-recip" id="access_form_recipient">
                        <label>
                            {{-- Error handling --}}
                            @if( $errors->has('recip_access_checkbox') )
                                <div class="alert alert-danger">
                                    {{ $errors->first('recip_access_checkbox') }}
                                </div>
                            @endif
                            {{-- Label --}}
                            I require:
                        </label><br /><br />
                        {{-- Add in all accessibility restrictions in foreach --}}
                        @foreach($data->access as $access )
                            <input type="checkbox" name="recip_access_checkbox[]" value="{{$access->short_name}}"
                                @if( is_array(old('recip_access_checkbox')) && in_array($access->short_name, old('recip_access_checkbox')))
                                    checked
                                @endif
                            />
                            <label class="block font-medium text-sm text-gray-700"> {{$access->short_name}}</label><br />
                        @endforeach
                        <textarea cols="100" rows="6" name="recip_access_other" id="recip_access_other" >{{ old('recip_access_other')}}</textarea><br />
                        <label class="block font-medium text-sm text-gray-700">Please specify (255 characters max)</label>
                        @if ($errors->has('recip_access_other'))
                            <div class="alert alert-danger">
                                {{$errors->first('recip_access_other')}}
                            </div>
                        @endif
                    </fieldset><br /><br />
                    {{--
                        Guest Accessibility section.
                            - Guest accessibility radio.
                            - Guest accessibility checkbox.
                            - Guest accessibilty other.
                    --}}

                    <label class="block font-medium text-sm text-gray-700"><strong>Does your guest require accessibility considerations?</strong><br />
                        <input type="radio" name="guest_access" id="guest_access" value="true" @if(old('guest_access') == "true") checked @endif > yes
                        <input type="radio" name="guest_access" id="guest_access" value="false" @if(old('guest_access') != null && old('guest_access') != "true") checked @endif > no
                    </label>
                    @if ($errors->has('guest_access'))
                        <div class="alert alert-danger">
                            {{ $errors->first('guest_access') }}
                        </div>
                    @endif
                    <br />
                    <fieldset class="form-group" name="access-group-recip" id="accessible_form_guest">
                        <label>Accessibility Considerations for Guests</label><br /><br />
                        {{-- Add in all accessibility restrictions in foreach --}}
                        @foreach($data->access as $access )
                            <input type="checkbox" name="guest_access_checkbox[]" value="{{$access->short_name}}"
                                @if( is_array(old('guest_access_checkbox')) && in_array($access->short_name, old('guest_access_checkbox')))
                                   checked
                                @endif
                            />
                            <label class="block font-medium text-sm text-gray-700"> {{$access->short_name}}</label><br />
                        @endforeach
                        <textarea cols="100" rows="6" name="guest_access_other" id="guest_access_other" >{{ old('guest_access_other')}}</textarea><br />
                        <label class="block font-medium text-sm text-gray-700">Please specify (255 characters max)</label>
                        @if($errors->has('guest_access_other'))
                            <div class="alert alert-danger">
                                {{ $errors->first('guest_access_other') }}
                            </div>
                        @endif
                    </fieldset>
                </fieldset>
            </div><br /><br />


            {{-------------------------------------------
                Dietary section
             ------------------------------------------}}
            <div class="form-group">
                {{--
                    Recipient Dietary section.
                        - Recipient Dietary radio.
                        - Recipient Dietary checkbox.
                        - Recipient Dietary other.
                --}}
                <fieldset class="form-group" name="dietary" id="dietary_group">
                    <fieldset class="form-group" name="diet-group-recip" id="diet_form_recipient">
                        {{-- Guest dietary radio yes/no --}}
                        <label class="block font-medium text-sm text-gray-700"><strong>Do you have dietary requirements? </strong><br />
                            <input type="radio" name="recipient_diet" id="recipient_diet_true" value="true" @if(old('recipient_diet') == "true") checked @endif> yes
                            <input type="radio" name="recipient_diet" id="recipient_diet_false" value="false"  @if(old('recipient_diet')  != null && old('recipient_diet')  != "true") checked @endif> no
                        </label>
                        @if ($errors->has('recipient_diet'))
                            <div class="alert alert-danger">
                                {{ $errors->first('recipient_diet') }}
                            </div>
                        @endif
                        <br /><br />
                        <label>I require food options that are:</label><br /><br />
                        {{-- Add in all dietary restrictions checkboxes in foreach --}}
                        @foreach($data->diet as $diet )
                            <input type="checkbox" name="recip_diet_checkbox[{{ $diet->id }}]" value="{{$diet->short_name}}"
                                   @if (is_array(old('recip_diet_checkbox')) && in_array($diet->short_name, old('recip_diet_checkbox')))
                                   checked
                                @endif
                            />
                            <label class="block font-medium text-sm text-gray-700"> {{$diet->short_name}}</label><br />
                        @endforeach
                        {{-- recipient dietary restrictions other textblock --}}
                        <textarea cols="100" rows="6" name="recip_diet_other" id="recip_diet_other" >{{ old('recip_diet_other')}}</textarea><br />
                        <label class="block font-medium text-sm text-gray-700">Please specify (255 characters max)</label>
                        @if ($errors->has('recip_diet_other'))
                            <div class="alert alert-danger">
                                {{ $errors->first('recip_diet_other') }}
                            </div>
                        @endif
                    </fieldset><br /><br />

                    <fieldset class="form-group" name="diet-group-diet" id="diet_form_guest">
                        {{--
                            Guest Dietary section.
                                - Guest Dietary radio.
                                - Guest Dietary checkbox.
                                - Guest Dietary other.
                        --}}
                        {{-- Guest dietary radio yes/no --}}
                        <label class="block font-medium text-sm text-gray-700"><strong>Does your guest have dietary requirements?</strong><br />
                            <input type="radio" name="guest_diet" id="guest_diet_true" value="true"  @if(old('guest_diet') == "true") checked @endif> yes
                            <input type="radio" name="guest_diet" id="guest_diet_false" value="false" @if(old('guest_diet')  != null && old('guest_diet') !== "true") checked @endif> no
                        </label>
                        @if ($errors->has('guest_diet'))
                            <div class="alert alert-danger">
                                {{ $errors->first('guest_diet') }}
                            </div>
                        @endif
                        <br /><br />

                        <label>My guest requires food options that are:</label><br /><br />
                        {{-- Add in all dietary restrictions checkboxes in foreach --}}
                        @foreach($data->diet as $diet )
                            <input type="checkbox" name="guest_diet_checkbox[]" value="{{$diet->short_name}}"
                                @if ( is_array(old('guest_diet_checkbox')) && in_array($diet->short_name, old('guest_diet_checkbox')))
                                   checked
                                @endif
                            />
                            <label class="block font-medium text-sm text-gray-700"> {{$diet->short_name}}</label><br />
                        @endforeach
                        {{-- Guest dietary other textbox --}}
                        <textarea name="guest_diet_other" id="guest_diet_other" cols="100" rows="6"  >{{ old('guest_diet_other')}} </textarea><br />
                        <label class="block font-medium text-sm text-gray-700">Please specify (255 characters max)</label>
                        @if ($errors->has('guest_diet_other'))
                            <div class="alert alert-danger">
                                {{$errors->first('guest_diet_other')}}
                            </div>
                        @endif
                    </fieldset>
                </fieldset>
            </div>
            {{debug($errors)}}
            {{------------------------------
                Contact information section.
            -------------------------------}}
            <div class="form-group">
                <fieldset class="form-group" name="contact-info" id="contact-info-fieldset">
                    <div id="contact-details-preamble">
                        <p>Please confirm your contact details so we can ensure you receive your Long Service Awards gift.</p><br />
                        {{-- Gift location radio yes/no --}}
                        <label class="block font-medium text-sm text-gray-700"><strong>Where would you like your gift sent?</strong><br />
                            <input type="radio" name="gift_location" id="gift_location" value="home"  @if(old('gift_location') == "true") checked @endif> Home
                            <input type="radio" name="gift_location" id="gift_location_false" value="office" @if(old('gift_location')  != null && old('gift_location') !== "true") checked @endif> Office
                        </label>
                        <p>If you have your gift sent to your office, your ministry may arrange for your supervisor or a member of executive to present it to you.</p><br />
                    </div><br />
                    {{--
                        Address fields.
                    --}}
                    <div id="gift-location-address">
                        <label class="block font-medium text-sm text-gray-700"> Floor/room/care of:
                            <input type="text" name="gift_location_floor" value="{{old('gift_location_floor')}}" />
                        </label><br />
                        <label class="block font-medium text-sm text-gray-700"> suit | address:
                            <input type="text" name="gift_location_addr" value="{{old('gift_location_addr')}}" />
                        </label><br />
                        <label class="block font-medium text-sm text-gray-700"> postal code:
                            <input type="text" name="gift_location_postal" value="{{old('gift_location_postal')}}" />
                        </label><br /><br />
                    </div>
                </fieldset>
            </div>
            {{-- Contact update radio yes/no --}}
            <div id="contact-update">
                <label class="block font-medium text-sm text-gray-700">Do you need to update your contact information?<br />
                    <input type="radio" name="contact-update" id="contact-update" value="true"  @if(old('contact-update') == "true") checked @endif> yes
                    <input type="radio" name="contact-update" id="contact-update" value="false" @if(old('cntact-update')  != null && old('contact-update') !== "true") checked @endif> no
                </label>
            </div><br />

            {{--------------------------------------
                Retirement Section
            ----------------------------------------}}
            <div class="retirement-section">
                <fieldset class="form-group" name="retirement" id="retirement-fieldset">
                    <div id="retirement-fields">
                        {{-- Retirement status radio y/n --}}
                        <label class="block font-medium text-sm text-gray-700">Are you retiring before your Long Service Awards ceremony?<br />
                            <input type="radio" name="retirement-status" id="retirement-status" value="true"  @if(old('retirement-status') == "true") checked @endif> yes
                            <input type="radio" name="retirement-status" id="retirement-status" value="false" @if(old('retirement-status')  != null && old('retirement-status') !== "true") checked @endif> no
                        </label><br />
                        <label class="block font-medium text-sm text-gray-700">  When are you retiring?
                            <input type="date" id="retirement-date" name="retirement-date">
                        </label>
                    </div><br />
                </fieldset>
            </div>
            {{--
                Email/Phone update.
                This shows for an RSVP if they note they want to update their contact info.
                This also shows for non-RSVP as part of the gift send.
                This also shows if the user notes that they are retiring.
            --}}
            <div id="retirement-note">
                How can we contact you after that date?
            </div>
            <div class="Form-group">
                <fieldset class="form-group" name="preferred-contact" id="preferred-contact-fieldset">
                    <div id="prefered-contact-fields">
                        <label class="block font-medium text-sm text-gray-700"> Preferred email:
                            <input type="text" name="preferred_email" value="{{old('preferred_email')}}" />
                        </label><br />
                        <label class="block font-medium text-sm text-gray-700"> Preferred phone:
                            <input type="text" name="preferred_phone" value="{{old('preferred_phone')}}" />
                        </label><br />
                    </div><br />
                </fieldset>
            </div>

            {{--------------------------
                Submit button.
            -------------------------}}
            <div class="form-group">
                <x-button class="ml-3">
                    {{ __('Submit') }}
                </x-button>
            </div>

        </form>
    </div>
</div>
@endsection('content')
