@extends('master')

@section('title')
Project Details
@stop

@section('content')
<h1>Project details</h1>
{{ HTML::linkRoute('projHoursRoute', 'View Hours', array($project->id), array('class' => 'btn btn-primary')) }}
{{ HTML::linkRoute('projHoursAdd', 'Add Hours', array($project->id), array('class' => 'btn btn-primary')) }}
{{ HTML::linkRoute('projInspectionsView', 'View Inspections', array($project->id), array('class' => 'btn btn-primary')) }}

<h2>{{ $project->project_name }}</h2>

 {{ Form::open(array('class'=>'form-horizontal')) }}
<section class="generalInfo col-md-7">
    <div class="form-group">
    </div>
    <div class="form-group">
        {{ Form::label('build_number', 'Build Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('build_number',$project->build_number,array('class'=>'form-control')) }}
        </div>
    </div>
    </div>
        <div class="form-group">
        {{ Form::label('family', 'Family: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('family',null,array('class'=>'form-control')) }}
        </div>
    </div>
        
    <div class="form-group">
        {{ Form::label('street_number', 'Street number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('street_number',$project->street_number,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('city', 'City: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('city',$project->city,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('province', 'Province: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('province',$project->province,array('class'=>'form-control')) }}
        </div>
    </div>    
    <div class="form-group">
        {{ Form::label('postal_code', 'Postal Code: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('postal_code',$project->postal_code,array('class'=>'form-control')) }}
        </div>
    </div>
        
    </div>
        <div class="form-group">
        {{ Form::label('role', 'Project Coordinator: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('role',$project->role,array('class'=>'form-control')) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label('start_date', 'Start Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','start_date',$project->start_date,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('end_date', 'End date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','end_date',$project->end_date,array('class'=>'form-control')) }}
        </div>
    </div>
    
    </div>
        <div class="form-group">
        {{ Form::label('designer', 'Blueprint Designer: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('designer',$project->designer,array('class'=>'form-control')) }}
        </div>
    </div>
    </div>
        <div class="form-group">
        {{ Form::label('plan_number', 'Blueprint Plan Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('plan_number',$project->plan_number,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('building_permit_number', 'Building Permit Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('building_permit_number',$project->building_permit_number,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('building_permit_date', 'Building Permit Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','building_permit_date',$project->building_permit_date,array('class'=>'form-control')) }}
        </div>
    </div>
        <div class="form-group">
        {{ Form::label('mortgage_date', 'Mortgage Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','mortgage_date',$project->mortgage_date,array('class'=>'form-control')) }}
        </div>
    </div>      
    <div class="form-group">
        {{ Form::label('comments', 'Comments: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::textarea('comments',$project->comments,array('class'=>'form-control')) }}
        </div>
    </div>

</section>

@stop            
