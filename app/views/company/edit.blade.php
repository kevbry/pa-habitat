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
$contactSearch->configureOnClickEvent(sprintf(HabitatSearchBox::SELECT_ID_ON_CLICK, 'primary_contact_1'))
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

<h1>Company details</h1>
<h2>Editing Details for {{ $company->name }}</h2>
{{ Form::open(array('method'=>'PUT','route'=>array('company.update', $company->id), 'class'=>'form-horizontal', 'id'=>'form')) }}
<section class="row"> 
    <section class="generalInfo col-md-7"> 
        <div class="form-group">
            {{ Form::label('name', 'Company Name: ',array('class'=>'col-sm-7')) }}
            <div class="col-sm-7">
                {{ Form::text('name',$company->name,array('class'=>'form-control')) }}
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-7">
            @if(!empty($errorList['name']))
                <div class="inputError">{{$errorList['name']}}</div>
            @endif
            </div>
        </div>    

        <div class="form-group">
            {{ Form::label('contain_id', 'Main Contact: ',array('class'=>'col-sm-7')) }}

            <div id="oldData" class="col-sm-7">
                {{ Form::text('con',$company->mainContact->first_name . " " .  $company->mainContact->last_name,array('class'=>'form-control','readonly'=>'readonly')) }}
                {{Form::hidden('primary_contact_1',$company->mainContact->id)}}
            </div>
            <div id="edit" class="col-sm-7">
                <?php $contactSearch->show() ?>
            </div>
            <div class="col-sm-4"></div>
            <div class="col-sm-6">
            @if(!empty($errorList['primary contact 1']))
                <div class="inputError">{{$errorList['primary contact 1']}}</div>
            @endif
            </div>
        </div>
            <div id="changeButton">
                <a href="#" class="btn btn-primary change">Change Main Contact</a>
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