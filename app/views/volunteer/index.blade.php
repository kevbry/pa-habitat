@extends('master')

@section('title')
Volunteers
@stop

@section('Content')
<h1>Volunteers</h1>
<a href="volunteer/create">Add Volunteer</a>
<table>
    <thead>
        <tr><th>Name</th><th>Last Safety Orientation</th><th>Active</th></tr>
    </thead>
    @foreach($volunteers as $volunteer)
    <tr>
        <td>{{$contact->first_name . ' ' . $contact->last_name}}</td>
        <td>{{$volunteer->last_attended_safety_meeting_date}}</td>
        <td>{{$volunteer->active_status}}</td>
        <td><a href="contact/{{$contact->id}}">View Details</a></td>
        <td></td>
    </tr>
    @endforeach
</table>
@stop
