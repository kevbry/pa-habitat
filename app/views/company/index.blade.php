@extends('master')

@section('title')
All Companies
@stop

@section('content')

<h1>Companies</h1>
<nav>
<a href="company/create" class="btn btn-primary">Add Company</a>
</nav>
<table class="table table-hover">
    <thead>
        <tr><th>Name</th><th></th></tr>
    </thead>
    @foreach($companies as $company)
    <tr>
        <td>{{$company->company_name}}</td>
        <td><a href="company/{{$company->id}}">View Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $companies->links(); ?>
@stop
