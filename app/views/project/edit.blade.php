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
<?php
//Define our array of error messages
//Neet to set this to the number of inputs you want validated

$errorList = array (
    'build number' => '',
    'name' => '',
    'street number' => '',
    'postal code' => '',
    'city' => '',
    'province' => '',
    'start date' => '',
    'end date' => '',
    'comments' => '',
    'building permit date' => '',
    'building permit number' => '',
    'mortgage date' => '',
    'blueprint plan number' => '',
    'blueprint designer' => '',
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
            //that is used in ContactValidator, or the name that comes up in
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

@extends('master')

@section('title')
Edit Project
@stop
@if($errors->any())


<h1>{{$errors->first()}}</h1>
@endif
@section('content')
<h2>Editing Details for {{ $project->name }}</h2>

{{ Form::open(array('method'=>'PUT','route'=>array('project.update', $project->id), 'class'=>'form-horizontal', 'id'=>'form')) }}
<section class="row">
<section class="generalInfo col-md-7">
    <h3>Project Details</h3>
    <div class="form-group">
        {{ Form::label('build_number', 'Build Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
            {{ Form::text('build_number',$project->build_number,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
        <div class="col-sm-7">
            @if(!empty($errorList['build number']))
                <div class="inputError">{{$errorList['build number']}}</div>
            @endif
        </div>        
    </div>
</div>
{{ Form::hidden('updated_at', date('Y-m-d H:i:s')) }}

<div class="form-group">
    {{ Form::label('street_number', 'Street Address: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::text('street_number',$project->street_number,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['street number']))
            <div class="inputError">{{$errorList['street number']}}</div>
        @endif
    </div>
</div>
<div class="form-group">
    {{ Form::label('city', 'City: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::text('city',$project->city,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['city']))
            <div class="inputError">{{$errorList['city']}}</div>
        @endif
    </div>
</div>
<div class="form-group">
    {{ Form::label('province', 'Province: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::text('province',$project->province,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['province']))
            <div class="inputError">{{$errorList['province']}}</div>
        @endif
    </div>
</div>    
<div class="form-group">
    {{ Form::label('postal_code', 'Postal Code: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::text('postal_code',$project->postal_code,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['postal code']))
            <div class="inputError">{{$errorList['postal code']}}</div>
        @endif
    </div>
</div>

<div class="form-group">
    {{ Form::label('start_date', 'Start Date: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::input('date','start_date',$project->start_date,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['start date']))
            <div class="inputError">{{$errorList['start date']}}</div>
        @endif
    </div>    
</div>
<div class="form-group">
    {{ Form::label('end_date', 'End date: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::input('date','end_date',$project->end_date,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="form-group">
        {{ Form::label('end_date', 'End date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','end_date',null,array('class'=>'form-control')) }}
        </div>
    </div>
</div>

</div>
<div class="form-group">
    {{ Form::label('designer', 'Blueprint Designer: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::text('blueprint_designer',$project->blueprint_designer,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['blueprint designer']))
            <div class="inputError">{{$errorList['blueprint designer']}}</div>
        @endif
    </div>
</div>
</div>
<div class="form-group">
    {{ Form::label('blueprint_plan_number', 'Blueprint Plan Number: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::text('blueprint_plan_number',$project->blueprint_plan_number,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['blueprint plan number']))
            <div class="inputError">{{$errorList['blueprint plan number']}}</div>
        @endif
    </div>
</div>
<div class="form-group">
    {{ Form::label('building_permit_number', 'Building Permit Number: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::text('building_permit_number',$project->building_permit_number,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['building permit number']))
            <div class="inputError">{{$errorList['building permit number']}}</div>
        @endif
    </div>
</div>
<div class="form-group">
    {{ Form::label('building_permit_date', 'Building Permit Date: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
        {{ Form::input('date','building_permit_date',$project->building_permit_date,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
        @if(!empty($errorList['building permit date']))
            <div class="inputError">{{$errorList['building permit date']}}</div>
        @endif
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
<section class="col-md-5"> 
    <div class="form-group">
        <h3>Additional Details</h3>
<!--        {{ Form::label('project_coordinator', 'Project Coordinator: ') }}
        @if (!empty($projectContact))
        {{ Form::text('project_coordinator',$projectContact,array('class'=>'form-control')) }}
        @else

        {{Form::text('project_coordinator','Not Specified',array('class'=>'form-control','readonly'=>'readonly')) }}
        @endif-->
    </div>
    <div class="form-group">
        {{ Form::label('family', 'Family: ') }}
        <div id="familySet">
            {{ Form::text('fam',$family ? $family->name : "Not Assigned" ,array('class'=>'form-control','readonly'=>'readonly')) }}
            {{Form::hidden('family',$family->id)}}
        </div>
        <div id="editFamily">
            <?php $familySearch->show() ?>
        </div>
        <div id="changeFamButton">
            <a href="#" class="btn btn-primary changeFam">Change Family</a>
        </div>
    </div>
</section>
</section>
<section class="row text-right">
    <div class="col-md-5 pull-right">
{{HTML::linkAction('ProjectController@show', "Discard Changes", array($project->id), array('class'=>'btn btn-primary btn-lg')) }}
{{Form::submit('Save Changes',array('class'=>'btn btn-primary btn-lg', 'onclick'=>'confirmExit(false); return false;'))}}
    </div>
</section>
{{Form::close()}}
 {{ HTML::script('assets/js/EditProjStyle.js');}}
@stop            
