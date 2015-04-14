@extends('master')

@section('title')
Add Volunteer Hours for Project {{$id}}
@stop

@section('content')
<?php

$count = 0;
//Define our array of error messages
//Need to set this to the number of inputs you want validated, for
//simplicities sake down the road.
$errorList = array();

//for each input array, add the fields appended with their number.
for($i = 0; $i < count(Input::old('hours')); $i++)
{
    $errorList['volunteer id.' . $i] = '';
    $errorList['hours.' . $i] = '';
    $errorList['date of contribution.' . $i] = '';
    $errorList['project id.' . $i] = '';
    $errorList['paid hours.' . $i] = '';
    $errorList['family id.' . $i] = '';
}
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
                
                $errorList[key($errorList)] = preg_replace('/\.\d+/', '', $error);
            }
            //Move the key pointer.
            next($errorList);
        }
    }
}
?>
<script type="text/html" id="rowtemplate">
    <?php $templateRow = new ProjectRowBuilder(
            $project->id,
            $project->name,
            $volunteers,
            $families,
            $errorList, 1,
            array());
            echo $templateRow->compileRow();
    ?>
</script>
<h1>Volunteer Hours for {{$project->name}}</h1>
{{ Form::open(array('route'=>'storehours','class'=>'form-horizontal')) }}
<a href="#" id="addhours" class="btn btn-primary btn-lg">Add Row</a>
{{Form::submit('Save All',array('class'=>'btn btn-primary btn-lg'))}}
<table class="table">
    <thead>
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th><th>Project</th><th>Family</th></tr>
    </thead>
    <tbody>
        <?php
            if (count(Input::old('hours')) === 0)
            {
                $testRow = new ProjectRowBuilder(
                    $project->id,
                    $project->name,
                    $volunteers,
                    $families,
                    $errorList, 0,
                    array());

                echo $testRow->compileRow();
            }
        
            // Add the rows  
            for($i=0; $i < count(Input::old('hours')); $i++)
            {
                $rowData = array();
                $rowData['volunteer_id'] = Input::old('volunteer_id')[$i];
                $rowData['hours'] = Input::old('hours')[$i];
                $rowData['date_of_contribution'] = Input::old('date_of_contribution')[$i];
                $rowData['paid_hours'] = Input::old('paid_hours')[$i];
                $rowData['project_id'] = Input::old('project_id');
                $rowData['family_id'] = Input::old('family_id')[$i];
                
                $testrow = new ProjectRowBuilder(
                    $project->id,
                    $project->name,
                    $volunteers,
                    $families,
                    $errorList, $i,
                    $rowData);

                echo $testrow->compileRow();
            }    
        ?>   
    </tbody>
</table>

{{Form::hidden('pageType','project')}}
{{Form::close()}}
 {{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
@stop
