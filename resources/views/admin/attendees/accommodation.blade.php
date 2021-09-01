@extends('blank')

@section('content')

    <h2>Updating Accommodation Info for {{$recipient->first_name}} {{$recipient->last_name}}</h2>

    <form method="post" action="{{url('attendees/accommodation/')}}/{{$recipient->id}}">
        @csrf
        <div class="row">

            <div class="col-4">
                <p>Recipient Accessibility</p>
              @foreach($accessibilityOptions as $option)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="1" name="recipient_access_{{$option->id}}" id="recipient_access_{{$option->id}}"
                    @foreach($recipient->attendee->accessibilityOptions as $selectedOptions)
                        @if($selectedOptions->id == $option->id)
                            checked
                        @endif
                    @endforeach
                    >
                    <label class="form-check-label" for="recipient_access_{{$option->id}}">{{$option->short_name}}</label>
                </div>
              @endforeach

                @if(!empty($recipient->guest))
                    <p>Guest Accessibility</p>
                @foreach($accessibilityOptions as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="guest_access_{{$option->id}}" name="guest_access_{{$option->id}}"
                               @foreach($recipient->guest->attendee->accessibilityOptions as $selectedOptions)
                               @if($selectedOptions->id == $option->id)
                               checked
                            @endif
                            @endforeach
                        >
                        <label class="form-check-label" for="guest_access_{{$option->id}}">{{$option->short_name}}</label>
                    </div>
                @endforeach

            @endif
            </div>
            <div class="col-4">
                <p>Recipient Dietary</p>
                @foreach($dietaryOptions as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="1" id="recipient_dietary_{{$option->id}}" name="recipient_dietary_{{$option->id}}"
                               @foreach($recipient->attendee->dietaryRestrictions as $selectedOptions)
                               @if($selectedOptions->id == $option->id)
                               checked
                            @endif
                            @endforeach
                        >
                        <label class="form-check-label" for="recipient_dietary_{{$option->id}}">{{$option->short_name}}</label>
                    </div>
                @endforeach


                @if(!empty($recipient->guest))
                    <p>Guest Dietary</p>
                    @foreach($dietaryOptions as $option)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="guest_dietary_{{$option->id}}" name="guest_dietary_{{$option->id}}"
                                   @foreach($recipient->guest->attendee->dietaryRestrictions as $selectedOptions)
                                   @if($selectedOptions->id == $option->id)
                                   checked
                                @endif
                                @endforeach
                            >
                            <label class="form-check-label" for="guest_dietary_{{$option->id}}">{{$option->short_name}}</label>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="recipient-accommodation-notes">Recipient Accommodation Notes</label>
                    <textarea class="form-control" name="recipient_accommodation_notes" id="recipient-accommodation-notes">@if(!empty($recipient->attendee->annotations)){{$recipient->attendee->annotations}}@endif</textarea>
                </div>
                @if(!empty($recipient->guest))
                <div class="form-group">
                    <label for="guest-accommodation-notes">Guest Accommodation Notes</label>
                    <textarea class="form-control" name="guest_accommodation_notes" id="guest-accommodation-notes">@if(!empty($recipient->guest->attendee->annotations)){{$recipient->guest->attendee->annotations}}@endif</textarea>
                </div>
                @endif
            </div>
        </div>

    <button class="btn btn-primary" type="submit">Update Accommodation Info.</button>

    </form>


@endsection
