@extends('admin.list')

@section('table-content')
    @foreach($attendees as $attendee)
            <tr>
                <td>{{$attendee->attendable->first_name}}</td>
                <td>{{$attendee->attendable->last_name}}</td>
                <td>{{$attendee->ceremony_id}}</td>
                <td>{{$attendee->attendable->milestone}}</td>
                <td>{{$attendee->organization->short_name}}</td>
                <td>{{$attendee->status}}</td>
            </tr>
    @endforeach
@endsection
