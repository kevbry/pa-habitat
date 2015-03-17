@extends('master')

@section('title')
Items for Project {{$volunteer->volunteer_name}}
@stop

@section('content')

<h1>Interests for {{$volunteer->name}}</h1> 
{{ HTML::linkRoute('editFormForInterests', 'Edit Interests', array($volunteer->id), array('class' => 'btn btn-primary')) }}
{{ Form::open(array('route'=>'storeInterests','class'=>'form-horizontal')) }}
<table class="table">
    <thead>
        <tr><th>Selected</th><th>Description</th></tr>
    </thead>
    <tbody>
        @if (!empty($interestdescriptions)) 
            @foreach($interestdescriptions as $description)
            <tr>
                <td></td>
                <td>{{$projectItem->item_type}}</td>
                
               
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{Form::close()}}
{{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
<?php 
if (!empty($projectItems))
{
    echo $projectItems->links();
}
 ?>
@stop
