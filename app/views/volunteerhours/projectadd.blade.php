@extends('master')

@section('title')
Add Volunteer Hours for Project {{$id}}
@stop

@section('content')

<h1>Volunteer Hours for {{$project->project_name}}</h1>
{{ Form::open(array('route'=>'storehours','class'=>'form-horizontal')) }}
<a href="#" id="addhours" class="btn btn-primary btn-lg">Add Row</a>
{{Form::submit('Save All',array('class'=>'btn btn-primary btn-lg'))}}
<table class="table">
    <thead>
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th><th>Project</th><th>Family</th></tr>
    </thead>
    <tbody>
        <tr class="hourrow">
            <td>
                <select name="volunteer_id[]" class="form-control">
            @if (!empty($volunteers))
                @foreach($volunteers as $volunteer)
                    <option value="{{$volunteer->id}}">{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</option>
                @endforeach
            @endif
                </select>
            </td>  
            <td>{{Form::number('hours[]', '0',array('min'=>0,'class'=>'form-control'))}}</td>
            <td>{{Form::input('date', 'date_of_contribution[]', null, array('class' => 'form-control', 'placeholder' => 'Date'))}}</td>
            <td>{{Form::select('paid_hours[]', array('0' => 'Volunteer', '1' => 'Paid'), '', array('min'=>0,'class'=>'form-control'));}}</td>
            <td>
                <select name="project_id[]" class="form-control">
                    <option value="{{$project->id}}">{{$project->project_name}}</option>
                </select>
            </td>
            <td>
                <select name="family_id[]" class="form-control">
                    <option value="0" selected>--</option>
                @if (!empty($families))
                @foreach($families as $family)
                    <option value="{{$family->id}}">{{$family->name}}</option>
                @endforeach
                @endif
                </select>
            </td>
            <td><a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>   
    </tbody>
</table>

{{Form::hidden('pageType','project')}}
{{Form::close()}}
 {{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id), array('class'=>'btn btn-primary btn-lg')) }}
@stop