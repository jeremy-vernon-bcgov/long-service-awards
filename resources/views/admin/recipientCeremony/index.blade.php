@extends('layouts.admin')

@section('title', 'Recipient Ceremonies')


@section('content')

    <table class="table">
        <thead>
        <tr>
            <th scope="col">Ceremony Number </th>
            <th scope="col">Ceremony Night</th>
            <th scope="col">Night Number</th>
            <th scope="col">Scheduled Datetime</th>
            <th scope="col">Ceremony Id</th>
            <th scope="col">Gov Email</th>
        </tr>
        </thead>
        @foreach($recipientceremonies as $ceremony)
            <tr>
                <td>{{$ceremony->night_number}}</td>
                <td>{{$ceremony->scheduled_datetime}}</td>
                <td>{{$ceremony->night_number}}</td>
                <td>{{$ceremony->scheduled_datetime}}</td>
                <td>{{$ceremony->ceremony_id}}</td>
                <td>{{$ceremony->government_email}}</td>
                <td><a href="#">Details</a></td>
            </tr>
        @endforeach
    </table>


@endsection
