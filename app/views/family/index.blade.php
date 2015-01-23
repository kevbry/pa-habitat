@extends('master')

@section('title')
Index of all Families
@stop

@section('content')

<h1>Contacts</h1>
<nav>
<a href="family/create" class="btn btn-primary">Add Family</a>
</nav>
<table class="table table-hover">
    <thead>
        <tr><th>Name</th><th>Status</th><th></th></tr>
    </thead>
    @foreach($families as $family)
    <tr>
        <td>{{$family->name}}</td>
        <td>{{$family->status}}</td>
        <td><a href="family/{{$family->id}}">View Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $families->links(); ?>
@stop
