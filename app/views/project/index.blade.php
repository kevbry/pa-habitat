@extends('master')

@section('title')
All Projects
@stop

@section('content')

<h1>Projects</h1>
<nav>
@if (Auth::check() && (Session::get('access_level') === 'project_manager' || 
Session::get('access_level') === 'administrator' ))
<a href="project/create" class="btn btn-primary">Add Projects</a>
@endif
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
<th>Street Address
                @if ($sortby == 's' && $order == 'd')
                 <a href='{{action(
                           'ProjectController@index',
                            array(
                               'sortby' => 's',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'ProjectController@index',
                            array(
                               'sortby' => 's',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                @endif</th>
            <th>City
                @if ($sortby == 'c' && $order == 'd')
                 <a href='{{action(
                           'ProjectController@index',
                            array(
                               'sortby' => 'c',
                                'order' => 'a'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span></a>
                    @else 
                  
                 <a href='{{action(
                           'ProjectController@index',
                            array(
                               'sortby' => 'c',
                                'order' => 'd'
                           )
                       )
                  }}'  ><span class="glyphicon glyphicon-chevron-up" aria-hidden="true"></span></a>
                @endif</th>
        </tr>
    </thead>
    @foreach($projects as $project)
    <tr>
        <td>{{$project->name}}</td>
        <td>{{$project->street_number}}</td>
        <td>{{$project->city}}</td>
        <td>{{$project->project_coordinator}}</td>
        <td><a href="project/{{$project->id}}">View Details</a> 
            @if (Auth::check() && (Session::get('access_level') === 'project_manager' || 
            Session::get('access_level') === 'administrator' ))    
            | <a href="project/{{$project->id}}/edit">Edit Details</a>
            @endif
        </td>
    </tr>
    @endforeach
</table>
<?php echo $projects->appends(array('sortby' => $sortby, 'order'=> $order ))->links(); ?>
@stop
