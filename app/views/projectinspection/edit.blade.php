@extends('master')

@section('title')
Edit Inspections for Project {{$project->project_name}}
@stop

@section('content')

<h1>Edit Inspections for {{$project->name}}</h1>
{{ Form::open(array('route'=>'updateFormInspections','class'=>'form-horizontal')) }}
{{ Form::submit('Save Changes', array('class'=>'btn btn-primary')) }}
<table class="table">
    <thead>
        <tr><th>Mandatory</th><th>Date</th><th>Type</th><th>Pass</th><th>Comments</th></tr>
    </thead>
    <tbody>
        {{Form::hidden('project_id', $project->id)}}
        
        @if (!empty($projectInspections)) 
            @foreach($projectInspections as $projectInspection)
            <tr class="formrow">
                {{Form::hidden('id[]', $projectInspection->id)}}
                <td><select name="mandatory[]" class="form-control">
                        <!-- The $key is the key to the PASS/FAIL, it is the 0/1 that we will pass in as the value-->
                        @foreach($mandatoryTypes as $key => $mandatoryType)
                            @if ($key === $projectInspection->mandatory)
                                <option selected value="{{$key}}">{{$mandatoryType}}</option>
                            @else
                                <option value="{{$key}}">{{$mandatoryType}}</option>
                            @endif
                        @endforeach
                </select>
                </td>
                <td>{{Form::input('date', 'date[]', $projectInspection->date, array('class'=>'form-control'))}}</td>
                <td>{{Form::input('type', 'type[]', $projectInspection->type, array('class'=>'form-control'))}}</td>
                <td><select name="pass[]" class="form-control">
                        <!-- The $key is the key to the PASS/FAIL, it is the 0/1 that we will pass in as the value-->
                        @foreach($inspectionPasses as $key => $inspectionPass)
                            @if ($key === $projectInspection->pass)
                                <option selected value="{{$key}}">{{$inspectionPass}}</option>
                            @else
                                <option value="{{$key}}">{{$inspectionPass}}</option>
                            @endif
                        @endforeach
                </select>
                </td>
                <td>{{Form::input('comments', 'comments[]', $projectInspection->comments, array('class'=>'form-control'))}}</td>
                <td><a href="#" class="removeEdit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{Form::close()}}
{{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
@stop
