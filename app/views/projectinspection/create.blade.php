@extends('master')

@section('title')
Add Inspections for Project {{$project->name}}
@stop

@section('content')
<script type="text/html" id="rowtemplate">
        <tr class="formrow">
            <td>{{Form::input('date', 'date[]', null, array('class' => 'form-control'))}}</td>
            <td>{{Form::text('type[]', null, array('class' => 'form-control'))}}</td>
            <td>{{Form::select('mandatory[]', array('0' => 'Non-Mandatory', '1' => 'Mandatory'), '', array('min'=>0,'class'=>'form-control'));}}</td>
            <td>{{Form::select('pass[]', array('0' => 'FAIL', '1' => 'PASS'), '', array('min'=>0,'class'=>'form-control'));}}</td>
            <td>{{Form::textarea('comments[]',null,array('class'=>'form-control', 'rows'=>3));}}</td>
            <td>{{Form::hidden('project_id',$project->id)}}
                <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>
</script>
<h1>Inspections for {{$project->name}}</h1>
{{ Form::open(array('route'=>'storeInspections','class'=>'form-horizontal')) }}
<a href="#" id="addhours" class="btn btn-primary btn-lg">Add Row</a>
{{Form::submit('Save All',array('class'=>'btn btn-primary btn-lg'))}}
<table class="table">
    <thead>
        <tr><th>Date</th><th>Type</th><th>Mandatory</th><th>Pass/Fail</th><th>Comments</th></tr>
    </thead>
    <tbody>
        <tr class="formrow">
            <td>{{Form::input('date', 'date[]', null, array('class' => 'form-control'))}}</td>
            <td>{{Form::text('type[]', null, array('class' => 'form-control'))}}</td>
            <td>{{Form::select('mandatory[]', array('0' => 'Non-Mandatory', '1' => 'Mandatory'), '', array('min'=>0,'class'=>'form-control'));}}</td>
            <td>{{Form::select('pass[]', array('0' => 'FAIL', '1' => 'PASS'), '', array('min'=>0,'class'=>'form-control'));}}</td>
            <td>{{Form::textarea('comments[]',null,array('class'=>'form-control', 'rows'=>3));}}</td>
            <td>{{Form::hidden('project_id',$project->id)}}
            <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>   
    </tbody>
</table>
{{Form::close()}}
 {{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
@stop

