@extends('admin.list')

@section('content')



    <div class="row">


        <h2>Unassigned Recipients</h2>

        <table class="reportTable table table-striped table-hover">
            <thead>
            <tr>
                <td>First</td>
                <td>Last</td>
                <td>Org</td>
                <td>Milestone</td>
                <td>Accommo.</td>
                <td>Ceremony</td>
            </tr>
            </thead>
            <tbody>
    @foreach ($unassigned_recipients as $recipient)
        <tr>
            <td>{{$recipient->first_name}}</td>
            <td>{{$recipient->last_name}}</td>
            <td>{{$recipient->organization->short_name}}</td>
            <td>{{$recipient->milestone}}</td>
            <td><a href="{{url('attendees/accommodation')}}/{{$recipient->id}}">Accommo.</a></td>
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
            </tbody>
        </table>
    </div>

        <div class="row">


            <h2>Assigned Recipients</h2>

            <table class="reportTable table table-striped table-hover">
                <thead>
                <tr>
                    <td>First</td>
                    <td>Last</td>
                    <td>Org</td>
                    <td>Milestone</td>
                    <td>Accommo.</td>
                    <td>Ceremony</td>
                </tr>
                </thead>
                <tbody>
                @foreach ($assigned_recipients as $recipient)
                    <tr>
                        <td>{{$recipient->first_name}}</td>
                        <td>{{$recipient->last_name}}</td>
                        <td>{{$recipient->organization->short_name}}</td>
                        <td>{{$recipient->milestone}}</td>
                        <td><a href="{{url('attendees/accommodation')}}/{{$recipient->id}}">Accommo.</a></td>
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
                </tbody>
            </table>
        </div>
@endsection
