@extends('master')

@section('title')
Add Volunteer Hours for Volunteer {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}
@stop

@section('content')

<h1>Volunteer Hours for {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}</h1>
{{ HTML::linkRoute('volHoursAdd', 'Add Hours', array($volunteer->id), array('class' => 'btn btn-primary'))}}
{{ HTML::linkAction('VolunteerHoursController@indexForEditContact','Edit Hours', array($volunteer->id), array('class'=>'btn btn-primary'))}}
{{ Form::open(array('route'=>'storehours','class'=>'form-horizontal'))}}

<table class="table">
    <thead>
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th><th>Project</th><th>Family</th></tr>
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
                <td>{{$volunteerhour->project->project_name}}</td>
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


{{Form::hidden('pageType','volunteer')}}
{{Form::close()}}
 {{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id)) }}
<?php 
if (!empty($volunteerhours))
{
    echo $volunteerhours->links();
}
?>

@stop
