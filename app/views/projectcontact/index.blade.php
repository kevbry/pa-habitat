@extends('master')

@section('title')
Contacts for Project     
@if (!empty($project))
    {{$project->name}}
@endif
@stop

@section('content')

<h1>Contacts for 
    @if (!empty($project))
    {{$project->name}}
@endif</h1>
@if (!empty($project))
{{ HTML::linkRoute('projContactsAdd', 'Add Contacts', array($project->id), array('class' => 'btn btn-primary')) }}
@endif
{{ Form::open(array('route'=>'projStoreContacts','class'=>'form-horizontal')) }}

<table class="table">
    <thead>
        <tr><th>Name</th><th>Role</th><th>Notes</th></tr>
    </thead>
    <tbody>
        @if (!empty($projectContacts)) 
            @foreach($projectContacts as $projectContact)
            <tr>
                <td>{{$projectContact->contact->first_name . " " . $projectContact->contact->last_name}}</td>
                <td>{{$projectContact->role->role}}</td>
                <td>{{$projectContact->notes}}</td>
                <td></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{Form::close()}}
@if (!empty($project))
{{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
@endif
<?php 
if (!empty($projectContacts))
{
    echo $projectContacts->links();
}
 ?>
@stop

