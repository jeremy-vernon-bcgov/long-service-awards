@extends('admin.list')

@section('table-content')
    @foreach($recipients as $recipient)
        <tr>
            <td>{{$recipient->first_name}}</td>
            <td>{{$recipient->last_name}}</td>
            <td>@if(!empty($certificateNames[$recipient->id]))
                    {{$certificateNames[$recipient->id]}}
                @else
                    N/A
                @endif
            </td>
            <td>{{$recipient->milestone}}</td>
            <td>{{$recipient->organization->short_name}}</td>
            <td>{{$recipient->ceremony->id ?? 'Unassigned'}}</td>
            <td><a href="{{url('award/updatepecsf')}}/{{$recipient->id}}">Edit</a></td>

        </tr>
    @endforeach
@endsection
