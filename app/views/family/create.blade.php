@extends('master')

@section('title')
Create a Family
@stop

@section('content')
<h1>Create a Family</h1>
{{ Form::open(array('route'=>'family.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <div class="form-group">
        {{ Form::label('family_name', 'Family Name: ',array('class'=>'col-sm-4')) }}
        <div class="col-sm-6">
        {{ Form::text('family_name',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <?php
        $PAGE_URL = Session::get('page_url');
        
        $primary_contact_1_search = new HabitatSearchBox($PAGE_URL, "primary_1", "Add Family Member...");
        $primary_contact_2_search = new HabitatSearchBox($PAGE_URL, "primary_2", "Add Family Member..."); 
        $secondary_contact_1_search = new HabitatSearchBox($PAGE_URL, "secondary_1", "Add Family Member..."); 
        $secondary_contact_2_search = new HabitatSearchBox($PAGE_URL, "secondary_2", "Add Family Member..."); 
        $secondary_contact_3_search = new HabitatSearchBox($PAGE_URL, "secondary_3", "Add Family Member..."); 

        $primary_contact_1_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'primary_contact_1'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('volunteerSearch1', "search/searchVolunteers?volunteers=%QUERY%", 'Volunteers')
            ->configureSettings()
            ->build();
        
        $primary_contact_2_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'primary_contact_2'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('volunteerSearch2', "search/searchVolunteers?volunteers=%QUERY%", 'Volunteers')
            ->configureSettings()
            ->build();
        
        $secondary_contact_1_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'secondary_contact_1'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('volunteerSearch3', "search/searchVolunteers?volunteers=%QUERY%", 'Volunteers')
            ->configureSettings()
            ->build();
        
        $secondary_contact_2_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'secondary_contact_2'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('volunteerSearch4', "search/searchVolunteers?volunteers=%QUERY%", 'Volunteers')
            ->configureSettings()
            ->build();
        
        $secondary_contact_3_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'secondary_contact_3'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('volunteerSearch5', "search/searchVolunteers?volunteers=%QUERY%", 'Volunteers')
            ->configureSettings()
            ->build();        
    ?>
    <div class="form-group">
        {{Form::label('primary_contact_1', 'Primary Contact 1: ', array('class'=>'col-sm-4'))}}
        <div class="col-sm-6">
            <?php $primary_contact_1_search->show(); ?>
        </div>
    </div>
      
    <div class="form-group">
        {{Form::label('primary_contact_2', 'Primary Contact 2: ', array('class'=>'col-sm-4'))}}
        <div class="col-sm-6">
            <?php $primary_contact_2_search->show(); ?>
        </div>
    </div>
    
    <!-- Secondary Contacts -->
    <div class="form-group">
        {{Form::label('secondary_contact_1', 'Secondary Contact 1: ', array('class'=>'col-sm-4'))}}
        <div class="col-sm-6">
            <?php $secondary_contact_1_search->show(); ?>
        </div>
    </div>
    
    <div class="form-group">
        {{Form::label('secondary_contact_2', 'Secondary Contact 2: ', array('class'=>'col-sm-4'))}}
        <div class="col-sm-6">
            <?php $secondary_contact_2_search->show(); ?>
        </div>
    </div>
    
    <div class="form-group">
        {{Form::label('secondary_contact_3', 'Secondary Contact 3: ', array('class'=>'col-sm-4'))}}
        <div class="col-sm-6">
            <?php $secondary_contact_3_search->show(); ?>
        </div>
    </div>
    
    <div class="form-group">
        {{ Form::label('comments', 'Comments:',array('class'=>'col-sm-4')) }}
        <div class="col-sm-6">
        {{ Form::textarea('comments',null,array('class'=>'form-control')) }}
        </div>
    </div>
    
</section>
</section>
<section class="row text-right">
      <div class="form-group">
        {{Form::submit('Create New Family',array('class'=>'btn btn-primary btn-lg'))}}
    </div>  
</section>
{{Form::close()}}
@stop