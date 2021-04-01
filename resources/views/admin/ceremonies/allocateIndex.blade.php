@extends('layouts.admin')

@section('title', 'Ceremonies')


@section('content')

    <h2>Organization Attendance by Ceremony</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Organization</th>
                @foreach($ceremonies as $ceremony)
                    <th><a href="">{{$ceremony->night_number}}</a></th>
                @endforeach
                <th>Total</th>
            </tr>
            <th>Total</th>
            @foreach($ceremonies as $ceremony)
                <td>{{$ceremony->attendee_count}}</td>
            @endforeach
                <td></td>
                </tr>
        </thead>
        <tbody>
        <tr>

                @foreach($organizations as $organization)
                    <tr>
                        <th><a href="">{{$organization->short_name}}</a></th>
                    @foreach($ceremonies as $ceremony)
                        <td>{{$ceremony->organizationAttendees($organization->id)}}</td>
                    @endforeach
                        <td>{{$organization->attendee_count}}</td>
                    </tr>
                @endforeach

        </tbody>
    </table>



@endsection
