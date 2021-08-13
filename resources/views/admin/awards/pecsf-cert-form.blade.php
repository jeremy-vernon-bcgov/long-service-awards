@extends('blank')

@section('content')
    <h2>Editing PECSF Certificate Options for {{$recipient->first_name}} {{$recipient->last_name}}</h2>
    <div class="row">


        <form method="post" action="{{url('award/updatepecsf')}}/{{$recipient->id}}">
            @csrf



            <div class="form-group">
                <label for="region">Region</label>
                <select class="form-control" id="region" name="region">
                    <option disabled selected>Select a Region</option>
                    @foreach($pecsfRegions as $pecsfRegion)
                        <option value="{{$pecsfRegion->id}}">{{$pecsfRegion->name}}</option>
                    @endforeach
                </select>
            </div>


            <div class="form-group">
                <label for="charity_1">Charity 1</label>
                <select class="form-control" id="charity_1" name="charity_1" >
                    <option selected>Select a Charity</option>
                    @foreach($pecsfCharities as $pecsfCharity)
                        <option class="charity_option" value="{{$pecsfCharity->id}}" data-region="{{$pecsfCharity->pecsf_region_id}}">{{$pecsfCharity->name}}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="charity_2">Charity 2</label>
                <select class="form-control" id="charity_2" name="charity_2" >
                    <option selected>Select a Charity</option>
                    @foreach($pecsfCharities as $pecsfCharity)
                        <option class="charity_option" value="{{$pecsfCharity->id}}" data-region="{{$pecsfCharity->pecsf_region_id}}">{{$pecsfCharity->name}}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>



    </div>




@endsection
@section('after_scripts')



    <script>
        $(document).ready(function($) {
            updateCharityOptions(getRegionID());
            $('#region').change(function() {
                updateCharityOptions(getRegionID());
            })
        });

        function getRegionID() {
          return  $('#region').val()
        }

        function updateCharityOptions(regionID) {
           let selector  = "option[data-region='" + regionID + "']";

            console.log(selector);
            $('.charity_option').hide();
            $(selector).show();
        }

    </script>
@endsection
