@extends('master')

@section('title')
Index of all contacts
@stop

@section('content')
<h1>Contacts</h1>
<a href="contact/create">Add Contact</a>

<table>
    <thead>
        <tr><th>Name</th><th>Phone</th><th>Email</th></tr>
    </thead>
    @foreach($contacts as $contact)
    <tr>
        <td>{{$contact->first_name . ' ' . $contact->last_name}}</td>
        <td>{{$contact->home_phone}}</td>
        <td>{{$contact->email_address}}</td>
        <td><a href="contact/show/{{$contact->id}}">View Details</a></td>
    </tr>
    @endforeach
</table>
@stop
