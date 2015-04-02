@extends('master')

@section('title')
Create a Company
@stop



@section('content')
<?php
//Define our array of error messages
//Need to set this to the number of inputs you want validated, for
//simplicities sake down the road.
$errorList = array(
    'name' => '',
    'primary contact 1' => ''
);
    //If there are errors

if($errors->any())
{
    //For every error
    foreach($errors->all() as $error)
    {
        $counter = 0;
        //For every entry in the "errorList" array
        //This array contains labels for each error, in order to append to
        //The correct fields and allow for scalability.
        foreach($errorList as $errorKey)
        {
            if($counter == 0)
            {
                prev($errorList);
                $counter++;
            }
            //If the error message contains the same field name aka 'first name'
            //Note this is not the field name first_name, this is the name
            //that is used in CompanyValidator, or the name that comes up in
            //the actually error message.
            if(strpos($error,key($errorList)) !== FALSE)
            {
                //Add it to the array under the key, so we can use it later.
                $errorList[key($errorList)] = $error;
            }
            //Move the key pointer.
            next($errorList);
        }
    }
}

?>
<h1>Create a Company</h1>
{{ Form::open(array('route'=>'company.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <div class="form-group">
        {{ Form::label('name', 'Company Name: ',array('class'=>'col-sm-4')) }}
        <div class="col-sm-6">
        {{ Form::text('name',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-4"></div>
        <div class="col-sm-7">
        @if(!empty($errorList['name']))
            <div class="inputError">{{$errorList['name']}}</div>
        @endif
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
        <div class="col-sm-4"></div>
        <div class="col-sm-6">
        @if(!empty($errorList['primary contact 1']))
            <div class="inputError">{{$errorList['primary contact 1']}}</div>
        @endif
        </div>
    </div>
    
</section>
</section>
<section class="row text-right">
    <div class="col-md-5 pull-right">
        {{Form::submit('Create New Company',array('class'=>'btn btn-primary btn-lg'))}}
    </div>
</section>
{{Form::close()}}
@stop