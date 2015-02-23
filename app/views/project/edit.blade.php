<?php
$PAGE_ROOT_URL = explode(Request::path(), Request::url())[0];

// Create the master search box located in the nav bar
$familySearch = new HabitatSearchBox($PAGE_ROOT_URL, "family-search", "Search for a Family");

Session::put('page_url', $PAGE_ROOT_URL);

/*
 *  Configure the search box
 *      Set up how the results are formatted.  First is the attribute to use as the value, second is what to display
 *      Set up the on click method (what happens when a result is selected)
 *      Set up the selection engine(s) that fetches and formats results from the database
 *      Set up the searchbox settings
 */
$familySearch->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'family'))
        ->configureDatumFormat('id', 'name')
        ->configureEngine('findFamily', HabitatSearchBox::SEARCH_FAMILY_URL, 'Family')
        ->configureSettings()
        ->build();
?> 

@extends('master')

@section('title')
Edit Project
@stop
@if($errors->any())


<h1>{{$errors->first()}}</h1>
@endif
@section('content')
<h2>Editing Details for {{ $project->name }}</h2>
 {{ HTML::script('assets/js/master.js');}}
{{ Form::open(array('method'=>'PUT','route'=>array('project.update', $project->id), 'class'=>'form-horizontal', 'id'=>'form')) }}
<section class="generalInfo col-md-7">
    <h3>Project Details</h3>
    <div class="form-group">
        {{ Form::label('build_number', 'Build Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
            {{ Form::text('build_number',$project->build_number,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
</div>
{{ Form::hidden('updated_at', date('Y-m-d H:i:s')) }}

<div class="form-group">
    {{ Form::label('street_number', 'Street Address: ',array('class'=>'col-sm-3')) }}
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
        {{ Form::text('blueprint_designer',$project->blueprint_designer,array('class'=>'form-control')) }}
    </div>
</div>
</div>
<div class="form-group">
    {{ Form::label('blueprint_plan_number', 'Blueprint Plan Number: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::text('blueprint_plan_number',$project->blueprint_plan_number,array('class'=>'form-control')) }}
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
{{HTML::linkAction('ProjectController@show', "Discard Changes", array($project->id), array('class'=>'btn btn-primary btn-lg')) }}
{{Form::submit('Save Changes',array('class'=>'btn btn-primary btn-lg', 'onclick'=>'confirmExit(false); return false;'))}}

</section>
<section class="col-md-5"> 
    <div class="form-group">
        <h3>Additional Details</h3>
        {{ Form::label('project_coordinator', 'Project Coordinator: ') }}
        @if (!empty($projectContact))
        {{ Form::text('project_coordinator',$projectContact,array('class'=>'form-control')) }}
        @else

        {{Form::text('project_coordinator','Not Specified',array('class'=>'form-control','readonly'=>'readonly')) }}
        @endif
    </div>
    <div class="form-group">

        {{ Form::label('family', 'Family: ') }}
        <div id="familySet">
            {{ Form::text('family',$family->name,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
        <div id="editFamily">
            <?php $familySearch->show(true) ?>
        </div>
        <div id="changeFamButton">
            <a href="#" class="btn btn-primary changeFam">Change Family</a>
        </div>
       
        
    </div>
</section>
@stop            
