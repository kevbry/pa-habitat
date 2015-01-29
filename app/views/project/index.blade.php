@extends('master')

@section('title')
All Projects
@stop

@section('content')

<h1>Projects</h1>
<nav>
<a href="project/create" class="btn btn-primary">Add Projects</a>
</nav>
<table class="table table-hover">
    <thead>
        <tr><th>Name</th><th></th></tr>
        
    </thead>
    @foreach($projects as $project)
    <tr>
        <td>{{$project->name}}</td>
          <td><a href="project/{{$project->id}}">View Details</a></td>
    </tr>
    @endforeach
</table>
<?php echo $projects->links(); ?>
@stop
