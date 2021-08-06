@extends('blank');


@section('content')

@foreach($ceremonies as $ceremony)

    <h2>Ceremony Of {{$ceremony['ceremony_of']}}</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Accommodation</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>

                    @foreach($ceremony['accessCounts'] as $accessCount)
                        @if ($accessCount['quantity'] > 0)
                        <tr>
                            <td>{{$accessCount['short_name']}}</td>
                            <td>{{$accessCount['quantity']}}</td>
                        </tr>
                        @endif
                    @endforeach
                    @foreach($ceremony['dietCounts'] as $dietCount)
                        @if ($accessCount['quantity'] > 0)
                            <tr>
                                <td>{{$accessCount['short_name']}}</td>
                                <td>{{$accessCount['quantity']}}</td>
                            </tr>
                        @endif
                    @endforeach

        </tbody>
    </table>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>Type</th>
                <th>First</th>
                <th>Last</th>
                <th>Organization</th>
                <th>Milestone</th>
                <th>Access Options</th>
                <th>Diet Options</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            @foreach($ceremony['attendees'] as $attendee)
                <tr>
                        @if($attendee->type == 'recipient')
                            <td>Recipient</td>
                            <td>{{$attendee->recipient->first_name}}</td>
                            <td>{{$attendee->recipient->last_name}}</td>
                            <td>{{$attendee->recipient->organization->short_name}}</td>
                            <td>{{$attendee->recipient->milestone}}</td>
                        @endif
                        @if ($attendee->type == 'guest')
                            <td>Guest</td>
                            <td>Guest Of</td>
                            <td>{{$attendee->guest->recipient->first_name}} {{$attendee->guest->recipient->last_name}}</td>
                            <td>{{$attendee->guest->recipient->organization->short_name}}</td>
                            <td></td>
                        @endif
                        @if ($attendee->type == 'vip')
                            <td>VIP</td>
                            <td>{{$attendee->vip->first_name}}</td>
                            <td>{{$attendee->vip->last_name}}</td>
                            <td>{{$attendee->vip->organization->short_name}}</td>
                            <td></td>
                        @endif
                        <td>
                            @if($attendee->accessibilityOptions->count() > 0)
                                <ul>
                                    @foreach($attendee->accessibilityOptions as $option)
                                        <li>{{$option->short_name}}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </td>
                        <td>
                            @if($attendee->dietaryRestrictions->count() > 0)
                                <ul>
                                    @foreach($attendee->dietaryRestrictions as $option)
                                        <li>{{$option->short_name}}</li>
                                    @endforeach
                                </ul>
                             @endif
                        </td>
                        <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>


@endforeach
@endsection
