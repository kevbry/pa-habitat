@extends('master')

@section('title')
All Donors
@stop

@section('content')

<h1>Donors</h1>
<table class="table table-hover">
    <thead>
        <tr><th>Name</th><th>Phone</th><th>Email</th><th></th></tr>
    </thead>
    @foreach($donors as $donor)
    <tr>
        <td>{{$donor->contact->first_name . ' ' . $donor->contact->last_name}}</td>
        <td>{{$donor->contact->home_phone}}</td>
        <td>{{$donor->contact->email_address}}</td>
        <td><a href="contact/{{$donor->id}}">View Details</a> / <a href="contact/{{$donor->id}}/edit">Edit Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $donors->links(); ?>
@stop
