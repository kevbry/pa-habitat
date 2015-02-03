@extends('master')

@section('title')
Project Details
@stop

@section('content')
<h1>Project details</h1>
<h2>{{ $project->name }}</h2>
{{ HTML::linkRoute('projHoursRoute', 'View Hours', array($project->id), array('class' => 'btn btn-primary')) }}
{{ HTML::linkRoute('projHoursAdd', 'Add Hours', array($project->id), array('class' => 'btn btn-primary')) }}


@stop            
