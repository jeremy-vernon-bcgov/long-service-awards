@extends('admin.list')

@section('table-content')
    @foreach($ceremonies as $ceremony)
        <tr>
            <td>{{$ceremony->scheduled_datetime}}</td>
            <td>{{$ceremony->attendees->where('type', 'recipient')->where('status', 'assigned')->count()}}</td>
            <td>{{$ceremony->attendees->where('type', 'recipient')->where('status', 'invited')->count()}}</td>
            <td>{{$ceremony->attendees->where('type', 'recipient')->where('status', 'attending')->count()}}</td>
            <td>{{$guestCount[$ceremony->id]}}</td>
            <td>{{$guestCount[$ceremony->id] + $ceremony->attendees->where('type', 'recipient')->where('status', 'attending')->count()}}</td>
            <td>{{$ceremony->attendees->where('type', 'recipient')->where('status', 'declined')->count()}}</td>
            <td>{{$ceremony->attendees->where('type', 'recipient')->where('status', 'declined')->count() + $ceremony->attendees->where('type', 'recipient')->where('status', 'attending')->count()
                }}
            </td>


        </tr>
        @endforeach
@endsection
