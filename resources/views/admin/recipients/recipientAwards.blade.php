@extends('admin.list')

@section('table-content')
    @foreach($recipients as $recipient)
        <tr>
            <td>{{$recipient->first_name}}</td>
            <td>{{$recipient->last_name}}</td>
            <td>{{$recipient->organization->short_name}}</td>
            <td>{{$recipient->award->short_name ?? 'none'}}</td>
            <td><a href="{{url("recipient/{$recipient->id}/award")}}">Edit Award Info</a></td>
        </tr>
    @endforeach
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
