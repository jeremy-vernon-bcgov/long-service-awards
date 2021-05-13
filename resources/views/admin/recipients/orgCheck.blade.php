@extends(backpack_view('blank'))

@section('title', 'Recipients with Organizational Memberships')




@section('content')

    <table class="table striped">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Organization</th>
            <th>Branch</th>
            <th>Edit</th>
        </tr>
        </thead>
        <tbody>
        @foreach($recipients as $recipient)
            <tr>
                <td>{{$recipient->first_name}}</td>
                <td>{{$recipient->last_name}}</td>
                <td>{{$recipient->organization->name}}</td>
                <td>{{$recipient->branch_name}}</td>
                <td><a href="/admin/recipient/{{$recipient->id}}/edit">Edit</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
