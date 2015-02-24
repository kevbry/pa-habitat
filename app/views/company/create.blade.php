@extends('master')

@section('title')
Create a Company
@stop

@section('content')
<h1>Create a Company</h1>
{{ Form::open(array('route'=>'company.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <div class="form-group">
        {{ Form::label('company_name', 'Company Name: ',array('class'=>'col-sm-4')) }}
        <div class="col-sm-6">
        {{ Form::text('company_name',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <?php
        $PAGE_URL = Session::get('page_url');
        
        $primary_contact_search = new HabitatSearchBox($PAGE_URL, "contact_id", "Add Main Contact...");

        $primary_contact_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'primary_contact_1'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('volunteerSearch1', HabitatSearchBox::SEARCH_CONTACT_URL, 'Contacts')
            ->configureSettings()
            ->build();
           
    ?>
    <div class="form-group">
        {{Form::label('primary_contact_1', 'Primary Contact 1: ', array('class'=>'col-sm-4'))}}
        <div class="col-sm-6">
            <?php $primary_contact_search->show(); ?>
        </div>
    </div>
    
</section>
</section>
<section class="row text-right">
      <div class="form-group">
        {{Form::submit('Create New Company',array('class'=>'btn btn-primary btn-lg'))}}
    </div>  
</section>
{{Form::close()}}
@stop