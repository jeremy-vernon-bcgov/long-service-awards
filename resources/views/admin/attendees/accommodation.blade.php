@extends('blank')

@section('content')

    <form method="post" action="{{url()}}">
        <div class="row">
            <div class="col-4">
              @foreach($accessibilityOptions as $option)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id=""
                    @foreach($recipient->attendee->accessibilityOptions as $selectedOptions)
                        @if($selectedOptions == $option)
                            checked
                        @endif
                    @endforeach
                    >
                    <label class="form-check-label" for=""></label>
                </div>
              @endforeach
            </div>
            <div class="col-4">
                @foreach($dietaryOptions as $option)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" id=""
                               @foreach($recipient->attendee->dietaryRestrictions as $selectedOptions)
                               @if($selectedOptions == $option)
                               checked
                            @endif
                            @endforeach
                        >
                        <label class="form-check-label" for=""></label>
                    </div>
                @endforeach
            </div>
            <div class="col-4">
                <div class="form-group">
                    <label for="recipient-accessibility-notes">

                    </label>
                </div>
            </div>
        </div>



    </form>


@endsection
