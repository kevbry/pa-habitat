@extends('master')

@section('title')
Create a Project
@stop

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
        <div class="col-sm-3"></div>
        <div class="col-sm-7">
            @if(!empty($errorList['name']))
                <div class="inputError">{{$errorList['name']}}</div>
            @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('build_number', 'Build Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('build_number',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-7">
            @if(!empty($errorList['build number']))
                <div class="inputError">{{$errorList['build number']}}</div>
            @endif
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
        {{ Form::text('city',null,array('class'=>'form-control')) }}
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
        {{ Form::text('province',null,array('class'=>'form-control')) }}
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
        {{ Form::text('postal_code',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-3"></div>
        <div class="col-sm-7">
            @if(!empty($errorList['postal code']))
                <div class="inputError">{{$errorList['postal code']}}</div>
            @endif
        </div>
    </div>        
    </div>
        <div class="form-group">
        {{ Form::label('project_coordinator', 'Project Coordinator: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        <?php $coordinator_search->show(); ?>
        </div>        
    </div>

    <div class="form-group">
        {{ Form::label('start_date', 'Start Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','start_date',null,array('class'=>'form-control')) }}
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
        {{ Form::input('date','end_date',null,array('class'=>'form-control')) }}
        </div>
    </div>
    
    </div>
        <div class="form-group">
        {{ Form::label('blueprint_designer', 'Blueprint Designer: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('blueprint_designer',null,array('class'=>'form-control')) }}
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
        {{ Form::text('blueprint_plan_number',null,array('class'=>'form-control')) }}
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
        {{ Form::text('building_permit_number',null,array('class'=>'form-control')) }}
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
        {{ Form::input('date','building_permit_date',null,array('class'=>'form-control')) }}
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