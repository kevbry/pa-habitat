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
        ->configureEngine('findContact', HabitatSearchBox::SEARCH_FAMILY_URL, 'Contact')
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
    <section class="col-md-5"> 

        <div class="form-group">

            <div id="editCompanyMain">
                <?php $contactSearch->show() ?>
            </div>

        </div>
    </section>
</section>
<section class="row text-right">
    <div class="col-md-5 pull-right">
        {{HTML::linkAction('Companyontroller@show', "Discard Changes", array($project->id), array('class'=>'btn btn-primary btn-lg')) }}
        {{Form::submit('Save Changes',array('class'=>'btn btn-primary btn-lg', 'onclick'=>'confirmExit(false); return false;'))}}
    </div>
</section>
{{Form::close()}}
@stop            