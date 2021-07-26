@extends('admin.list')

@section('content')
    <h1>Bracelets</h1>
    <div class="row">
        <div class="row mb-0">
            <div class="col-sm-6">
                <div class="d-print-none">
                    <!-- WHERE BUTTONS GO -->
                </div>
            </div>
            <div class="col-sm-6">
                <div id="datatable_search_stack" class="mt-sm-0 mt-2 d-print-none"></div>
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <td>Size</td>
                    <td>Qty</td>
                </tr>
            </thead>
            <tbody>
                @foreach($sizes as $size)
                    <tr>
                        <td>{{$size['text']}}</td>
                        <td>{{$size['count']}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>



        <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
            <thead>
            <tr>
                <td>First</td>
                <td>Last</td>
                <td>Award</td>
                <td>Size</td>
                <td>Milestone</td>
                <td>Org</td>
                <td>Ceremony</td>
                <td>Edit Award</td>
            </tr>
            </thead>
            <tbody>
            @foreach($recipients as $recipient)

                <tr>
                    <td>{{$recipient->first_name}}</td>
                    <td>{{$recipient->last_name}}</td>
                    <td>{{$recipient->award->short_name}}</td>
                    <td>{{$recipient->awardSelections->first()->value ?? 'not selected'}}</td>
                    <td>{{$recipient->milestone}}</td>
                    <td>{{$recipient->organization->short_name}}</td>
                    <td>{{$recipient->ceremony->scheduled_datetime ?? 'not assigned'}}</td>
                    <td><a href="{{url("recipient/{$recipient->id}/award")}}">Edit Award</a></td>
                </tr>

            @endforeach


            </tbody>


@endsection


@section('table-content')

@endsection
