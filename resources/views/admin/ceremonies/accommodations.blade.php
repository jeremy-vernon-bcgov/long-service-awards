@extends('admin.list')


@section('content')

@foreach($ceremonies as $ceremony)

<div class="row">
    <div class="col-12">
    <h2>{{$ceremony['ceremony_of']->format('l jS \of F Y')}}</h2>



    <div class="row">
        <div class="col-5">
            <h3>Summary</h3>
    <table class="reportTable table table-striped">
        <thead>
            <tr>
                <th>Accommodation</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>


                    @foreach($ceremony['accessCounts'] as $accessCount)
                        @if($accessCount['quantity'] > 0)
                        <tr>
                            <td>{{$accessCount['short_name']}}</td>
                            <td>{{$accessCount['quantity']}}</td>
                        </tr>
                        @endif
                    @endforeach

                    @foreach($ceremony['dietCounts'] as $dietCount)
                        @if($dietCount['quantity'])
                            <tr>
                                <td>{{$dietCount['short_name']}}</td>
                                <td>{{$dietCount['quantity']}}</td>
                            </tr>
                        @endif
                    @endforeach

        </tbody>
    </table>
        </div>
        <div class="col-7">
    <h3>list</h3>
    <table class="reportTable table table-striped">
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
                @if ($attendee->accessibilityOptions->count() > 0 || $attendee->dietaryRestrictions->count() > 0)

                <tr>
                        @if($attendee->type == 'recipient')
                            <td>Recipient</td>
                        <td><a href="{{url('attendees/accommodation')}}/{{$attendee->recipient->id}}">{{$attendee->recipient->first_name}}</a></td>
                        <td><a href="{{url('attendees/accommodation')}}/{{$attendee->recipient->id}}">{{$attendee->recipient->last_name}}</a></td>
                            <td>{{$attendee->recipient->organization->short_name}}</td>
                            <td>{{$attendee->recipient->milestone}}</td>
                        @endif
                        @if ($attendee->type == 'guest')
                            <td>Guest</td>
                            <td>Guest Of</td>
                                <td><a href="{{url('attendees/accommodation')}}/{{$attendee->guest->recipient->id}}">{{$attendee->guest->recipient->first_name}} {{$attendee->guest->recipient->last_name}}</a></td>
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
                        <td>{{$attendee->annotations}}</td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
        </div>
    </div>
    </div>
</div>
@endforeach
@endsection
@section('table-content')

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
