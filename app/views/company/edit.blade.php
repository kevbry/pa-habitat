<?php
$PAGE_ROOT_URL = explode(Request::path(), Request::url())[0];

// Create the master search box located in the nav bar
$contactSearch = new HabitatSearchBox($PAGE_ROOT_URL, "contact-search", "Search for a Contact");

Session::put('page_url', $PAGE_ROOT_URL);

/*
 *  Configure the search box
 *      Set up how the results are formatted.  First is the attribute to use as the value, second is what to display
 *      Set up the on click method (what happens when a result is selected)
 *      Set up the selection engine(s) that fetches and formats results from the database
 *      Set up the searchbox settings
 */
$contactSearch->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'contact'))
        ->configureDatumFormat('id', 'name')
        ->configureEngine('findContact', HabitatSearchBox::SEARCH_CONTACT_URL, 'Contact')
        ->configureSettings()
        ->build();
?> 

@extends('master')

@section('title')
Edit Company  
@stop

@section('content')
<h1>Company details</h1>
<h2>Editing Details for {{ $company->name }}</h2>
{{ Form::open(array('method'=>'PUT','route'=>array('company.update', $company->id), 'class'=>'form-horizontal', 'id'=>'form')) }}
<section class="row"> 
    <section class="generalInfo col-md-7"> 
        <div class="form-group">
            {{ Form::label('name', 'Company Name: ',array('class'=>'col-sm-3')) }}
            <div class="col-sm-7">
                {{ Form::text('name',$company->name,array('class'=>'form-control')) }}
            </div>
        </div>    

        <div class="form-group">
            {{ Form::label('contain_id', 'Main Contact: ',array('class'=>'col-sm-3')) }}

            <div id="familySet" class="col-sm-7">
                {{ Form::text('con',$contact->first_name . " " . $contact->last_name,array('class'=>'form-control','readonly'=>'readonly')) }}
                {{Form::hidden('contact_id',$company->contact_id)}}
            </div>
            <div id="editFamily" class="col-sm-7">
                <?php $contactSearch->show() ?>
            </div>
        </div>
            <div id="changeFamButton">
                <a href="#" class="btn btn-primary changeFam">Change Main Contact</a>
            </div>  
        
    </section>
</section>
<section class="row text-right">
    <div class="col-md-5 pull-right">
        {{HTML::linkAction('CompanyController@show', "Discard Changes", array($company->id), array('class'=>'btn btn-primary btn-lg')) }}
        {{Form::submit('Save Changes',array('class'=>'btn btn-primary btn-lg', 'onclick'=>'confirmExit(false); return false;'))}}
    </div>
</section>

{{Form::close()}}
{{ HTML::script('assets/js/EditProjStyle.js');}}
@stop            