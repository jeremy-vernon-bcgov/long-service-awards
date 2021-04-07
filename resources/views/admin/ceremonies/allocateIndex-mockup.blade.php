@extends('layouts.admin')

@section('title', 'Ceremonies')


@section('content')

    <h2>Organization Attendance by Ceremony</h2>
    <table class="table">
        <thead>
        <tr>
            <th>Cohort</th>
            <th>Count</th>
            <th>Ceremony</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td>Health | CRD  | 25</td>
            <td>35</td>
            <td><select><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></td>
        </tr>
        <tr>
            <td>Health | GVRD | 25</td>
            <td>8</td>
            <td><select><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></td>
        </tr>
        <tr>
            <td>Health | PROV | 25</td>
            <td>13</td>
            <td><select><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></td>
        </tr>
        <tr>
            <td>Health | CRD | 30</td>
            <td>6</td>
            <td><select><option>Unassigned</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></td>
        </tr>
        <tr>
            <td>Health | GVRD | 30</td>
            <td>6</td>
            <td><select><option>Unassigned</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></td>
        </tr>
        <tr>
            <td>Health | PROV | 30</td>
            <td>6</td>
            <td><select><option>Unassigned</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></td>
        </tr>
        <tr>
            <td>Health | CRD | 35</td>
            <td>6</td>
            <td><select><option>Unassigned</option><option>1</option><option>2</option><option>3</option><option>4</option><option>5</option></select></td>
        </tr>

        </tbody>
    </table>




@endsection
