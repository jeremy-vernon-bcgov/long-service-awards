@extends('blank')

@section('content')

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

        <table id="crudTable" class="bg-white table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
            <thead>
            <tr>
                @foreach ($columns as $column)
                    <th data-orderable="{{$column['orderable'], true}}"
                        data-priority="">
                        {!!$column['label']!!}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                @foreach($recipients as $recipient)
                    <tr>
                        <td>{{$recipient->first_name}}</td>
                        <td>{{$recipient->last_name}}</td>
                        <td>{{$recipient->ceremony->id}}</td>
                        <td>{{$recipient->awardSelection->where('award_option_id', '=', 1)}}</td>
                        <td>{{$recipient->awardSelection->where('award_option_id', '=', 2)}}</td>
                        <td>{{$recipient}}</td>
                    </tr>

                @endforeach

            </tbody>
            <tfoot>
            <tr>
                @foreach($columns as $column)
                    <th>{!! $column['label'] !!}</th>
                @endforeach
            </tr>
            </tfoot>
        </table>
    </div>

@endsection
