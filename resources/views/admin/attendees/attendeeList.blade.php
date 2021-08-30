@extends('admin.list')

@section('table-content')
    @foreach($attendees as $attendee)
        @if ($attendee->type == 'recipient')
            <tr>
                <td>{{$attendee->recipient->first_name}}</td>
                <td>{{$attendee->recipient->last_name}}</td>
                <td>{{$attendee->ceremony_id}}</td>
                <td>{{$attendee->recipient->milestone}}</td>
                <td>{{$attendee->recipient->organization->short_name}}</td>
                <td>@if (!empty($attendee->identifier))
                    {{$attendee->identifier}}
                    @endif
                </td>
                <td>{{$attendee->status}}</td>
            </tr>
            @endif
    @endforeach
@endsection
