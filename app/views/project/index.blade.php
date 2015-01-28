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
        <tr><th>project_name</th></tr>
    </thead>
    @foreach($projects as $project)
    <tr>
        <td>{{$project->project_name}}</td>
    </tr>
    @endforeach
</table>
<?php echo $projects->links(); ?>
@stop
