@extends('admin.list')

@section('table-content')
    @foreach($organization as $organization)
        <tr>
                <td>{{$organization->name}}</td>
                <td>{{$organization->attendees->where('type','recipient')->where('status', 'assigned')->count()}}</td>
                <td>{{$organization->attendees->where('type', 'recipient')->where('status', 'invited')->count()}}</td>
                <td>{{$organization->attendees->where('type', 'recipient')->where('status', 'attending')->count()}}</td>
                <td>{{$organization->attendees->where('type', 'guest')}}</td>
        </tr>

    @endforeach

@endsection
