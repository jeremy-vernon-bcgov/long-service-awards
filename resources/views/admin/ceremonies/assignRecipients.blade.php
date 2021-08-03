@extends('blank')

@section('content')



    <div class="row">
        <div class="row mb-0">
            <div class="col-sm-6">
                <div class="d-print-none">
                    <!-- WHERE BUTTONS GO -->
                </div>
            </div>
            <div class="col-sm-6">
                <div id="datatable_search_stack" class="mt-sm-0 mt-2 d-print-none"></div>
            </div>
        </div>

        <h2>Unassigned Recipients</h2>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <td>First</td>
                <td>Last</td>
                <td>Org</td>
                <td>Milestone</td>
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
            <div class="row mb-0">
                <div class="col-sm-6">
                    <div class="d-print-none">
                        <!-- WHERE BUTTONS GO -->
                    </div>
                </div>
                <div class="col-sm-6">
                    <div id="datatable_search_stack" class="mt-sm-0 mt-2 d-print-none"></div>
                </div>
            </div>

            <h2>Assigned Recipients</h2>

            <table class="table table-striped table-hover">
                <thead>
                <tr>
                    <td>First</td>
                    <td>Last</td>
                    <td>Org</td>
                    <td>Milestone</td>
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
