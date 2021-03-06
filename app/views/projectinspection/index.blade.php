@extends('master')

@section('title')
Inspections for Project {{$project->name}}
@stop

@section('content')

<h1>Inspections for {{$project->name}}</h1>
@if (Auth::check() && (Session::get('access_level') === 'project_manager' || 
Session::get('access_level') === 'administrator' ))
{{ HTML::linkRoute('projInspectionsAdd', 'Add Inspections', array($project->id), array('class' => 'btn btn-primary')) }}
{{ HTML::linkRoute('editFormForInspections', "Edit Inspections", array($project->id), array('class'=>'btn btn-primary')) }}
@endif
{{ Form::open(array('route'=>'storeInspections','class'=>'form-horizontal')) }}
<table class="table">
    <thead>
        <tr><th>Date</th><th>Type</th><th>Mandatory</th><th>Pass/Fail</th><th>Comments</th></tr>
    </thead>
    <tbody>
        @if (!empty($projectInspections)) 
            @foreach($projectInspections as $projectInspection)
            <tr>
                <td>{{$projectInspection->date}}</td>
                <td>{{$projectInspection->type}}</td>
                <td>
                <!-- Changes the true/false value from the database into either 
                Non-Mandatory (False), or
                Mandatory (True)-->
                @if($projectInspection->mandatory == 0)
                    Non-Mandatory
                @else
                    Mandatory
                @endif
                </td>
                <td>
                <!-- Changes the true/false value from the database into either 
                FAIL (False), or
                PASS (True)-->
                @if($projectInspection->pass == 0)
                    FAIL
                @else
                    PASS
                @endif
                </td>
                <td>{{$projectInspection->comments}}</td>
                <td></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{Form::close()}}
{{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
<?php 
if (!empty($projectInspections))
{
    echo $projectInspections->links();
}
 ?>
@stop

