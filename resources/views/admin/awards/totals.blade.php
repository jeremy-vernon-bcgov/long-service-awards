@extends('admin.list')

@section('table-content')
    @foreach($awards as $award)
        <tr>
            <td>{{$award->name}}</td>
            <td>{{$award->short_name}}</td>
            <td>{{$award->recipients_count}}</td>
        </tr>
    @endforeach

@endsection
