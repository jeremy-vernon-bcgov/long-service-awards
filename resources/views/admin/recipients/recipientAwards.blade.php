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
