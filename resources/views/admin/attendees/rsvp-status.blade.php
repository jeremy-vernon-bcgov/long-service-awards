@extends('admin.list')

@section('header')
    <h2>RSVP Status</h2>
@endsection

@section('table-content')

    @if ($attendees->count() > 0)

        @foreach($attendees as $attendee)

            <tr>
                <td>{{$attendee->recipient->first_name}}</td>
                <td>{{$attendee->recipient->last_name}}</td>
                <td>{{$attendee->ceremony->scheduled_datetime}}</td>
                <td>{{$attendee->recipient->organization->short_name}}</td>
                <td>{{$attendee->recipient->milestone}}</td>
                <td>{{$attendee->status}}</td>
                <td>
                    @if($attendee->status === 'attending')
                        @if(isset($attendee->recipient->guest))
                            yes
                        @else
                            no
                        @endif
                    @else
                        no
                    @endif
                </td>
            </tr>

        @endforeach
    @else

        <tr>
            <td colspan="7">No RSVPs Yet.</td>
        </tr>
    @endif

@endsection
