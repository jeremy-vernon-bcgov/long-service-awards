@extends('admin.list')

@section('table-content')
        @foreach($recipients as $recipient)
            <tr>
                <td>{{$recipient->first_name}}</td>
                <td>{{$recipient->last_name}}</td>
                <td></td>
                <td>{{$recipient->organization->short_name}}</td>
                <td>{{$recipient->ceremony->id ?? 'Unassigned'}}</td>
            </tr>
        @endforeach
@endsection
