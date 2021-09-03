@extends('admin.list')

@section('header')
    <h2>Awards Selection Totals</h2>
@endsection

@section('table-content')
    @foreach($awards as $award)
        <tr>
            <td>{{$award->name}}</td>
            <td>{{$award->short_name}}</td>
            <td>{{$award->recipients_count}}</td>
        </tr>
    @endforeach
        <tr>
            <td>Already Received</td>
            <td>No-Award</td>
            <td>{{$awardReceived}}</td>
        </tr>
@endsection

@section('jsTableConfig')
    <script>
        var reportTableConfig = {
            dom: 'liftBp',
            fixedHeader: true,
            autoWidth: false,
            buttons: ['excel'],
            pageLength: 50,
            lengthMenu: [[25,50,75,100,-1],[25,50,75,100,'All ']],
            aaSorting: [],
        }
        let tableConfigs = [reportTableConfig];
    </script>
@endsection


