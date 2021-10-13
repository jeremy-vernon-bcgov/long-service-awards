@extends('admin.list')

@section('header')
    <h2>Recipient RSVP Summary</h2>
@endsection

@section('content')

    <table class="reportTable table table-striped">
        <thead>
            <tr>
               <th>First Name</th>
                <th>Last Name</th>
                <th>Org.</th>
                <th>RSVP status</th>
                <th>Guest</th>
                <th>Gov. Email</th>
                <th>Personal Email</th>
                <th>Preferred Contact</th>
            </tr>
        </thead>
        <tbody>
    @foreach($recipients as $recipient)
        <tr>
        <td>{{$recipient->first_name}}</td>
        <td>{{$recipient->last_name}}</td>
        <td>{{$recipient->organization->short_name}}</td>
        <td>{{$recipient->attendee->status}}</td>
        <td>
            @if($recipient->attendee->status == 'attending' && !empty($recipient->guest->attendee))
                Yes
            @elseif ($recipient->attendee->status == 'attending' && empty($recipient->guest->attendee))
                No
            @else
                -
            @endif
        </td>
        <td>{{$recipient->government_email}}</td>
        <td>{{$recipient->personal_email}}</td>
        <td>{{$recipient->preferred_contact}}</td>
        </tr>
    @endforeach
        </tbody>
    </table>
@endsection
@section('jsTableConfig')
    <script>
        var reportTableConfig = {
            dom: 'liftBp',
            fixedHeader: true,
            autoWidth: false,
            buttons: ['excel'],
            pageLength: 50,
            lengthMenu: [[25,50,75,100,-1],[25,50,75,100,'All ']],
            aaSorting: [],
        }
        let tableConfigs = [reportTableConfig];
    </script>
@endsection
