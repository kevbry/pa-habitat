@extends('master')

@section('title')
Index of all contacts
@stop

@section('content')

<h1>Contacts</h1>
<nav>
<a href="contact/create" class="btn btn-primary">Add Contact</a>
</nav>
<table class="table table-hover">
    <thead>
        <tr><th>Name</th><th>Phone</th><th>Email</th><th></th></tr>
    </thead>
    @foreach($contacts as $contact)
    <tr>
        <td>{{$contact->first_name . ' ' . $contact->last_name}}</td>
        <td>{{$contact->home_phone}}</td>
        <td>{{$contact->email_address}}</td>
        <td><a href="contact/{{$contact->id}}">View Details</a> / <a href="contact/{{$contact->id}}/edit">Edit Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $contacts->links(); ?>
@stop
