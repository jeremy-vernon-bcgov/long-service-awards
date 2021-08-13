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
                <td>
                    <form method="post" action="{{url('/attendee/updatersvp')}}/{{$attendee->recipient->id}}">
                        @csrf
                        <div class="form-group">
                            <select name="status">
                                <option value="attending"  @if($attendee->status === 'attending') selected @endif>Attending</option>
                                <option value="declined"   @if($attendee->status === 'declined') selected @endif>Declined</option>
                                <option value="waitlisted" @if($attendee->status === 'waitlisted') selected @endif>Waitlisted</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </td>
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
