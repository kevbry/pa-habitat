@extends('master')

@section('title')
Contacts for Project {{$project->name}}
@stop

@section('content')

<h1>Contacts for {{$project->name}}</h1>
{{ HTML::linkRoute('projContactsAdd', 'Add Contacts', array($project->id), array('class' => 'btn btn-primary')) }}
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
                <td>{{$projectContact->role}}</td>
                <td>{{$projectContact->notes}}</td>
                <td></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{Form::close()}}
{{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
<?php 
if (!empty($projectContacts))
{
    echo $projectContacts->links();
}
 ?>
@stop

