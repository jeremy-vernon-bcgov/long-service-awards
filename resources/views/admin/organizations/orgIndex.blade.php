@extends('layouts.admin')

@section('title', 'Organizations')


@section('content')

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Recipients</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($organizations as $organization)
                <tr>
                    <td><a href="#">{{$organization->name}}</a></td>
                    <td>{{$organization->recipients_count}}</td>
                    <td></td>
                </tr>

            @endforeach

        </tbody>
    </table>

@endsection
