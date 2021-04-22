@extends(backpack_view('blank'))

@section('title', 'Recipient Totals')




@section('content')

    <table class="table striped">
        <thead>
        <tr>
            <th>Organization</th>
            <th>Total</th>
            <th>20 year</th>
            <th>25 year</th>
            <th>30 year</th>
            <th>35 year</th>
            <th>40 year</th>
            <th>45 year</th>
            <th>50 year</th>
        </tr>
        </thead>
        <tbody>
        @foreach($organizations as $organization)
            <tr>
              <td>{{$organization->name}}</td>
              <td>{{$organization->recipients_count}}</td>
              <td>{{$organization->milestone_20_recipients}}</td>
                <td>{{$organization->milestone_25_recipients}}</td>
                <td>{{$organization->milestone_30_recipients}}</td>
                <td>{{$organization->milestone_35_recipients}}</td>
                <td>{{$organization->milestone_40_recipients}}</td>
                <td>{{$organization->milestone_45_recipients}}</td>
                <td>{{$organization->milestone_50_recipients}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
