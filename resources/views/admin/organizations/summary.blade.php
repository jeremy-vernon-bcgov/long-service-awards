@extends(backpack_view('blank'))

@section('title', 'Summary')
@section('content')

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Milestone</th>
                <th># Recipients</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>20 year</td>
                <td>{{$organization->milestone_20_recipients}}</td>
            </tr>
            <tr>
                <td>25 year</td>
                <td>{{$organization->milestone_25_recipients}}</td>
            </tr>
            <tr>
                <td>30</td>
                <td>{{$organization->milestone_30_recipients}}</td>
            </tr>
            <tr>
                <td>35</td>
                <td>{{$organization->milestone_35_recipients}}</td>
            </tr>
            <tr>
                <td>40</td>
                <td>{{$organization->milestone_40_recipients}}</td>
            </tr>
            <tr>
                <td>45</td>
                <td>{{$organization->milestone_45_recipients}}</td>
            </tr>
            <tr>
                <td>50</td>
                <td>{{$organization->milestone_50_recipients}}</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>{{$organization->recipients_count}}</td>
            </tr>
        </tbody>
    </table>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Community</th>
                <th># Recipients</th>
            </tr>
        </thead>
        <tbody>
            @foreach($communities as $community)
                @if ($community->recipient_count > 0)
                  <tr>
                      <td>{{$community->name}}</td>
                  </tr>
                  <tr>
                      <td>{{$community->recipients_count}}</td>
                  </tr>
                @endif
            @endforeach;
        </tbody>
    </table>

@endsection
