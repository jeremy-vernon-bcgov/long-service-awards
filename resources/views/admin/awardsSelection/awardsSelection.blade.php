@extends('layouts.admin')

@section('title', 'Awards Selections')



@section('content')

    <table class="table striped">
        <thead>
        <tr>
            <th>Award</th>
            <th>Options</th>
            <th>Count</th>
        </tr>
        </thead>
        <tbody>
        @foreach($awards as $award)
            <tr>
                <td>{{ $award['award_name'] }}</td>
                <td>{{ $award['award_options'] }}</td>
                <td>{{ $award['award_count'] }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
