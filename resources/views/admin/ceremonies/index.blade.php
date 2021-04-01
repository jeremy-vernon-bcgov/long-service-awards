@extends('layouts.admin')

@section('title', 'Ceremonies')


@section('content')



    <a href="{{route('addCeremony')}}">Add Ceremony</a>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">Night #</th>
                <th scope="col">Date Time</th>
                <th scope="col">Attached</th>
                <th scope="col">Invited</th>
                <th scope="col">Confirmed</th>
                <th scope="col">Guests</th>
                <th scope="col">Waitlisted</th>
                <th scope="col">VIPs</th>
                <th scope="col">Details</th>
            </tr>
        </thead>
    @foreach($ceremonies as $ceremony)
        <tr>
            <td>{{$ceremony->night_number}}</td>
            <td>{{$ceremony->scheduled_datetime}}</td>
            <td>{{$ceremony->attendee_count}}</td>
            <td>{{$ceremony->invited_count}}</td>
            <td>{{$ceremony->attending_count}}</td>
            <td>{{$ceremony->guest_count}}</td>
            <td>{{$ceremony->waitlisted_count}}</td>
            <td>{{$ceremony->vip_count}}</td>
            <td><a href="#">Details</a></td>
        </tr>
    @endforeach
    </table>


@endsection
