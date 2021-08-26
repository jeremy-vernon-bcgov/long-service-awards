@extends('admin.list')

@section('header')
    <h2>Customizable Watch Report</h2>
@endsection

@section('content')


        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <td>Size</td>
                    <td>Colour</td>
                    <td>Strap</td>
                    <td>Qty</td>
                </tr>
            </thead>
            <tbody>
                @foreach($watchSizes as $watchSize)
                    @foreach($watchColours as $watchColour)
                        @foreach($watchStraps as $watchStrap)
                            @if (!empty($watches[$watchSize][$watchColour][$watchStrap]) && (count($watches[$watchSize][$watchColour][$watchStrap])) > 0)
                                <tr>
                                    <td>{{$watchSize}}</td>
                                    <td>{{$watchColour}}</td>
                                    <td>{{$watchStrap ?? 'undefined'}}</td>
                                    <td>{{count($watches[$watchSize][$watchColour][$watchStrap])}}</td>
                                </tr>
                            @endif
                        @endforeach
                    @endforeach
                @endforeach
            </tbody>
        </table>


        <table class="reportTable table table-striped table-hover nowrap rounded shadow-xs border-xs mt-2" cellspacing="0">
            <thead>
            <tr>
                @foreach ($columns as $column)
                    <th data-orderable="{{$column['orderable'], true}}"
                        data-priority="">
                        {!!$column['label']!!}
                    </th>
                @endforeach
            </tr>
            </thead>
            <tbody>
                @foreach($recipients as $recipient)
                    <tr>
                        <td>{{$recipient->first_name}}</td>
                        <td>{{$recipient->last_name}}</td>
                        <td>{{$recipient->ceremony->id ?? 'unassigned'}}</td>
                        @if ($recipient->awardSelections)
                            <td>{{$recipient->awardSelections->where('award_option_id', 1)->first()->value ?? 'none selected'}}</td>
                            <td>{{$recipient->awardSelections->where('award_option_id', 2)->first()->value ?? 'none selected'}}</td>
                            <td>{{$recipient->awardSelections->where('award_option_id', 3)->first()->value ?? 'none selected'}}</td>
                            <td>{{$recipient->awardSelections->where('award_option_id', 4)->first()->value ?? 'none selected'}}</td>
                        @else
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        @endif
                        <td><a href="{{url("recipient/{$recipient->id}/award")}}">Edit Award</a></td>

                    </tr>

                @endforeach

            </tbody>
            <tfoot>
            <tr>
                @foreach($columns as $column)
                    <th>{!! $column['label'] !!}</th>
                @endforeach
            </tr>
            </tfoot>
        </table>
    </div>


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
