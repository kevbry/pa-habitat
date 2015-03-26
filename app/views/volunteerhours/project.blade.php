@extends('master')

@section('title')
Volunteer Hours for Project {{$id}}
@stop

@section('content')

<h1>Volunteer Hours for {{$project->name}}</h1>
@if (Auth::check() && (Session::get('access_level') === 'project_managers' || Session::get('access_level') === 'administrator' ))
{{ HTML::linkRoute('projHoursAdd', 'Add Hours', array($project->id), array('class' => 'btn btn-primary')) }}
{{ HTML::linkAction('projHoursEdit','Edit Hours', array($project->id), array('class'=>'btn btn-primary'))}}
@endif
{{ Form::open(array('route'=>'storehours','class'=>'form-horizontal')) }}
<table class="table">
    <thead>
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th><th>Project name</th><th>Family</th></tr>
    </thead>
    <tbody>
        @if (!empty($volunteerhours)) 
            @foreach($volunteerhours as $volunteerhour)
            <tr>
                <td>{{$volunteerhour->volunteer->contact->first_name . ' ' . $volunteerhour->volunteer->contact->last_name}}</td>
                <td>{{$volunteerhour->hours}}</td>
                <td>{{$volunteerhour->date_of_contribution}}</td>
                <td>
                @if($volunteerhour->paid_hours == 0)
                    Volunteer
                 @else
                     Paid
                 @endif
                </td>
                <td>{{$volunteerhour->project->name}}</td>
                <td>
                @if(isset($volunteerhour->family->name))
                {{$volunteerhour->family->name}}
                @else
                --
                @endif</td>
                <td></td>
            </tr>
            @endforeach
        @endif
       
    </tbody>
</table>
{{Form::hidden('pageType','project')}}
{{Form::close()}}
 {{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id) )}}
<?php 
if (!empty($volunteerhours))
{
    echo $volunteerhours->links();
}
 ?>
@stop
