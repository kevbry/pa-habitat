@extends('master')

@section('title')
Create a User
@stop

@section('content')
<h1>Create a User</h1>
{{ Form::open(array('route'=>'user.store','class'=>'form-horizontal')) }}

<?php
    // Testing display of an error message
//    if(count($errors->all()) > 0)
//    {
//        print_r($errors->all()[1]);
//    }

    $PAGE_ROOT_URL = explode(Request::path(), Request::url())[0];

    $contact_search = new HabitatSearchBox($PAGE_ROOT_URL, "contact_search", "Select Contact...");

    $contact_search->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'contact_id'))
            ->configureDatumFormat('id', 'name')
            ->configureEngine('contactSearch', HabitatSearchBox::SEARCH_CONTACT_URL, 'Contacts')
            ->configureSettings()
            ->build();
?>

<section class="row">
<section class="col-md-7">
    <div class="form-group">
        {{ Form::label('username', 'Username: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
            {{ Form::input('text', 'username',null,array('class'=>'form-control')) }}
        </div>
    </div>    
    <div class="form-group">
        {{ Form::label('contact_id', 'Associated Contact: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
            <?php $contact_search->show(); ?>
        </div>
    </div>    
    <div class="form-group">
        {{ Form::label('password', 'Password: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('password', 'password',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('confirm_password', 'Confirm Password: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('password', 'confirm_password',null,array('class'=>'form-control')) }}
        </div>
        
        
    </div>
</section>
</section>
<section class="row text-right">
    <div class="col-md-5 pull-right">
        {{Form::submit('Save New User',array('class'=>'btn btn-primary btn-lg'))}}
    </div>
</section>

{{Form::close()}}


@stop