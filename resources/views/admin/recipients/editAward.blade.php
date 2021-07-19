@extends('blank')

@section('content')

    @error('title')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror

    <form method="post" action="">
        @csrf
        @method('PUT')


        <div class="row">
                <table class="table">
                    <tr><td>Name</td><td>{{$recipient->first_name}} {{$recipient->last_name}}</td></tr>
                    <tr><td>Milestone</td><td>{{$recipient->milestone}}</td></tr>
                    <tr><td>Organization</td><td>{{$recipient->organization->short_name}}</td></tr>
                </table>

                <div class="form-group">
                    <label for="award_id">Select Award </label>
                    <select class="form-control" id="award_id" name="award_id">
                        <option disabled>Select Award</option>
                        @foreach ($awards as $award)
                            <option value="{{$award->id}}"
                                @if($award->id == $recipient->award_id)
                                    selected
                                @endif
                            >{{$award->name}} ( {{$award->short_name}} )</option>
                        @endforeach
                    </select>
                </div>
        </div>

                <div id="watch_options" class="award-options collapse">
                    <div class="row">
                            <div class="form-group">
                                <label for="watch_size">Watch Size</label>
                                <select class="form-control" id="watch_size">
                                    <option disabled>Select a Size</option>
                                    <option @if (!empty($watch_size) && $watch_size == '38mm face with 20mm strap') selected @endif>38mm face with 20mm strap</option>
                                    <option @if (!empty($watch_size) && $watch_size == '29mm face with 14mm strap') selected @endif>29mm face with 14mm strap</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="watch_colour">Watch Colour</label>
                                <select class="form-control" id="watch_colour">
                                    <option disabled>Select a Colour</option>
                                    <option @if (!empty($watch_colour) && $watch_colour == 'Gold') selected @endif>Gold</option>
                                    <option @if (!empty($watch_colour) && $watch_colour == 'Silver') selected @endif>Silver</option>
                                    <option @if (!empty($watch_colour) && $watch_colour == 'Two-Toned (Gold and Silver)') selected @endif>Two-Toned (Gold and Silver)</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="watch_strap">Watch Strap</label>
                                <select class="form-control" id="watch_strap">
                                    <option disabled>Select a Watch Strap</option>
                                    <option @if (!empty($watch_strap) && $watch_strap == 'Plated') selected @endif>Plated</option>
                                    <option @if (!empty($watch_strap) && $watch_strap == 'Black Leather') selected @endif>Black Leather</option>
                                    <option @if (!empty($watch_strap) && $watch_strap == 'Brown Leader') selected @endif>Brown Leather</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="watch_engraving">Watch Engraving</label>
                                <input type="text" class="form-control" name="watch_engraving" id="watch_engraving"
                                       value="
                                            @if (!empty($watch_engraving))
                                                {{$watch_engraving}}
                                            @else
                                                {{$recipient->first_name}} {{$recipient->last_name}}
                                            @endif
                                            ">
                            </div>
                    </div>
                </div>

                <div id="bracelet_options" class="award-options collapse">
                    <div class="row">
                            <div class="form-group">
                                <label for="bracelet_size">Bracelet Size</label>
                                <select class="form-control" name="bracelet_size" id="bracelet_size">
                                    <option disabled>Select a Bracelet Size</option>
                                    <option @if (!empty($bracelet_size) && $bracelet_size == 'Fits 6 ½″ - 7 ½″ circumference wrists') selected @endif >Fits 6 ½″ - 7 ½″ circumference wrists</option>
                                    <option @if (!empty($bracelet_size) && $bracelet_size == 'Fits 7 ½″ - 8 ½″ circumference wrists') selected @endif >Fits 7 ½″ - 8 ½″ circumference wrists</option>
                                </select>
                            </div>
                    </div>
                </div>

                <div id="pecsf_options" class="award-options collapse">
                    <div class="row">
                        <div class="form-group">
                            <label for="certificate_name">Certificate Name</label>
                            <input type="text" class="form-control" name="certificate_name" id="certificate_name"
                                   value="
                                   @if (!empty($certificate_name))
                                   {{$certificate_name}}
                                   @else
                                   {{$recipient->first_name}} {{$recipient->last_name}}
                                   @endif
                                       ">
                        </div>
                    </div>
                </div>
            <button class="btn btn-primary" type="submit">Update</button>
    </form>
    <script>
        const watchIDs = [9];
        const braceletIDs = [12,29, 48];
        const pecsfIDs = [49, 50, 51, 52, 53, 54];



        function updateAwards(awardID) {
            $('.award-options').collapse('hide');
            if (watchIDs.includes(parseInt(awardID))){
                $('#watch_options').collapse('show');
            }
            if (braceletIDs.includes(parseInt(awardID))){
                $('#bracelet_options').collapse('show');
            }
            if (pecsfIDs.includes(parseInt(awardID))){
                $('#pecsf_options').collapse('show');
            }
        }
        function docReady(fn) {
            // see if DOM is already available
            if (document.readyState === "complete" || document.readyState === "interactive") {
                // call on next available tick
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }
        docReady(function() {

                updateAwards($('#award_id').val())
                $('#award_id').change(function() {
                    updateAwards($('#award_id').val())
                })

        })




    </script>

@endsection
