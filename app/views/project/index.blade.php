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
        <tr>
            <th>Name
            @if ($sortby == 'n' && $order == 'd')
                 <a href='{{action(
                           'ProjectController@index',
                            array(
                               'sortby' => 'n',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'ProjectController@index',
                            array(
                               'sortby' => 'n',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                    @endif
            </th>
        </tr>
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
