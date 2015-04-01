@extends('master')

@section('title')
Create a Project
@stop

@section('content')
<h1>Create a Project</h1>
{{ Form::open(array('route'=>'project.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <?php
   $PAGE_ROOT_URL = explode(Request::path(), Request::url())[0];
        
    $coordinator_search = new HabitatSearchBox($PAGE_ROOT_URL, "coordinator_search", "Select Project Coordinator...");
    $family_search = new HabitatSearchBox($PAGE_ROOT_URL, "family_search", "Select Family...");
    
    $family_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'family_id'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('familySearch', HabitatSearchBox::SEARCH_FAMILY_URL, 'Families')
            ->configureSettings()
            ->build();
    
    $coordinator_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'role'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('coordinatorSearch', HabitatSearchBox::SEARCH_CONTACT_URL, 'Contacts')
            ->configureSettings()
            ->build();
    ?>
        <div class="form-group">
            {{ Form::label('name', 'Project Name: ',array('class'=>'col-sm-3')) }}
            <div class="col-sm-7">
            {{ Form::text('name',null,array('class'=>'form-control')) }}
            </div>
        </div>
        <div class="form-group">
            {{ Form::label('build_number', 'Build Number: ',array('class'=>'col-sm-3')) }}
            <div class="col-sm-7">
            {{ Form::text('build_number',null,array('class'=>'form-control')) }}
            </div>
        </div>
        </div>
            <div class="form-group">
            {{ Form::label('family', 'Family: ',array('class'=>'col-sm-3')) }}
            <div class="col-sm-7">
            <?php $family_search->show(); ?>
            </div>
        </div>
        
    <div class="form-group">
        {{ Form::label('street_number', 'Street number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('street_number',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('city', 'City: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('city',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('province', 'Province: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('province',null,array('class'=>'form-control')) }}
        </div>
    </div>    
    <div class="form-group">
        {{ Form::label('postal_code', 'Postal Code: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('postal_code',null,array('class'=>'form-control')) }}
        </div>
    </div>
        
<!--    </div>
        <div class="form-group">
        {{ Form::label('project_coordinator', 'Project Coordinator: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        <?php $coordinator_search->show(); ?>
        </div>
    </div>-->

    <div class="form-group">
        {{ Form::label('start_date', 'Start Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','start_date',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('end_date', 'End date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','end_date',null,array('class'=>'form-control')) }}
        </div>
    </div>
    
    </div>
        <div class="form-group">
        {{ Form::label('blueprint_designer', 'Blueprint Designer: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('blueprint_designer',null,array('class'=>'form-control')) }}
        </div>
    </div>
    </div>
        <div class="form-group">
        {{ Form::label('blueprint_plan_number', 'Blueprint Plan Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('blueprint_plan_number',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('building_permit_number', 'Building Permit Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('building_permit_number',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('building_permit_date', 'Building Permit Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','building_permit_date',null,array('class'=>'form-control')) }}
        </div>
    </div>
        <div class="form-group">
        {{ Form::label('mortgage_date', 'Mortgage Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','mortgage_date',null,array('class'=>'form-control')) }}
        </div>
    </div>      
    <div class="form-group">
        {{ Form::label('comments', 'Comments: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::textarea('comments',null,array('class'=>'form-control')) }}
        </div>
    </div>
</section>
</section>
<section class="row text-right">
    <div class="col-md-5 pull-right">
            {{Form::submit('Create New Project',array('class'=>'btn btn-primary btn-lg'))}}
        </div>  
    </section>
</section>
</section>
{{Form::close()}}


@stop