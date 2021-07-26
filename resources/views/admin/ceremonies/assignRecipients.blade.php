@extends('admin.list')

@section('table-content')
    @foreach ($recipients as $recipient)
        <tr>
            <td>{{$recipient->first_name}}</td>
            <td>{{$recipient->last_name}}</td>
            <td>{{$recipient->organization->short_name}}</td>
            <td>{{$recipient->milestone}}</td>
            <td>
                <form method="post" action="{{url('ceremony/assign')}}/{{$recipient->id}}">
                    @csrf
                    <select name="ceremony_id" class="">
                       <option selected disabled>Select Ceremony</option>
                        @foreach($ceremonies as $ceremony)
                            <option value="{{$ceremony->id}}"
                            @if (!empty($recipient->ceremony_id) && $ceremony->id == $recipient->ceremony_id)
                                selected
                            @endif
                            >{{$ceremony->scheduled_datetime}}</option>
                        @endforeach
                   </select>
                    <button type="submit" class="btn btn-primary">Assign</button>
                </form>
            </td>
        </tr>

    @endforeach
@endsection
