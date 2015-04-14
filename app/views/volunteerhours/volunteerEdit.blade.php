@extends('master')

@section('title')
Add Volunteer Hours for Volunteer {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}
@stop

@section('content')
<?php

//Define our array of error messages
//Need to set this to the number of inputs you want validated, for
//simplicities sake down the road.
$errorList = array();

//for each input array, add the fields appended with their number.
$array_keys = array_keys(Input::old());
$arrayIndexes = array();


if(in_array("deleted_hours", $array_keys))
{
    $arrayIndexes = array_keys(Input::old()['deleted_hours']);
}

for($i = 0; $i < count(Input::old('row_id')); $i++)
{
    if(!in_array(Input::old('row_id')[$i], $arrayIndexes))
    {
        $errorList['volunteer id.' . Input::old('row_id')[$i]] = '';
        $errorList['hours.' . Input::old('row_id')[$i]] = '';
        $errorList['date of contribution.' . Input::old('row_id')[$i]] = '';
        $errorList['project id.' . Input::old('row_id')[$i]] = '';
        $errorList['paid hours.' . Input::old('row_id')[$i]] = '';
        $errorList['family id.' . Input::old('row_id')[$i]] = '';
    }
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
        //die;
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
            //the actual error message.
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


<!-- Get the volunteer name and display it -->
<h1>Editing Volunteer Hours for {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}</h1>
{{ Form::open(array('route'=> array('updatehours'),'class'=>'form-horizontal')) }}
{{Form::submit('Save All',array('class'=>'btn btn-primary','id'=>'submitEdit'))}}
<br />

@if(count($volunteerhours) > 8)

        <div style="max-height:460px;overflow:scroll;overflow-x:hidden;">

@else

        <div>

@endif
<table class="table">
    <thead style="position: inherit">
        <!--If no hours were found display that, otherwise display the table. -->
        @if (count($volunteerhours) == 0)
            <tr><h3>No hours found for {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}</h3></tr>
        @else
            <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th><th>Project</th><th>Family</th></tr>
        @endif
    </thead>
        <tbody>
            <?php
                if(!empty(Input::old()))
                {
                    $existing_rows = Input::old()['row_id'];
                }
            ?>
                <!--For every hour for the volunteer-->
                @if (!empty($volunteerhours))
                    @foreach($volunteerhours as $volunteerhour)
                    
                        <?php $count = $volunteerhour->id; ?>
                    
                        @if(empty($existing_rows) || in_array($volunteerhour->id, $existing_rows))
                            <tr>
                                {{Form::hidden('vol_id', $volunteer->id)}}
                            </tr>
                            <tr class="formrow">
                                <td>
                                    <input id='row_id[]' name='row_id[]' type='hidden' value='{{$volunteerhour->id}}'></input>   
                                    {{Form::input('name', 'volunteer_name', $volunteer->contact->first_name . ' ' . $volunteer->contact->last_name, 
                                                array('readonly'=>'readonly', 'class'=>'form-control'))}}
                                </td>
                                <td>
                                    {{Form::number("hours[" . $count . "]", $volunteerhour->hours,array('min'=>0,'class'=>'form-control'))}}
                                    @if(!empty($errorList['hours.' . $count]))
                                        <div class="inputError">
                                            {{$errorList['hours.' . $count]}}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    {{Form::input('date', "date_of_contribution[" . $count . "]", $volunteerhour->date_of_contribution, array('class' => 'form-control'))}}
                                    @if(!empty($errorList['date of contribution.' . $count]))
                                    <div class="inputError">
                                        {{$errorList['date of contribution.' . $count]}}
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    @if($volunteerhour->paid_hours == 0)
                                        {{Form::select("paid_hours[" . $count . "]", array('0' => 'Volunteer', '1' => 'Paid'),'0', array('min'=>0,'class'=>'form-control'));}}
                                    @else
                                        {{Form::select("paid_hours[" . $count . "]", array('0' => 'Volunteer', '1' => 'Paid'),'1', array('min'=>0,'class'=>'form-control'));}}
                                    @endif
                                    @if(!empty($errorList['paid hours.' . $count]))
                                    <div class="inputError">
                                        {{$errorList['paid hours.' . $count]}}
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <select name="project_id[{{$count}}]" class="form-control">
                                        @if(!empty($projects))
                                            @foreach($projects as $project)
                                                @if($project->id == $volunteerhour->project_id)
                                                    <option value="{{$project->id}}" selected='selected'>{{$project->name}}</option>
                                                @else
                                                    <option value="{{$project->id}}">{{$project->name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(!empty($errorList['project id.' . $count]))
                                    <div class="inputError">
                                        {{$errorList['project id.' . $count]}}
                                    </div>
                                    @endif
                                </td>
                                <td>
                                    <select name="family_id[{{$count}}]" class="form-control">
                                        <option value="0" selected>--</option>
                                        @if (!empty($families))
                                            @foreach($families as $family)
                                                @if($family->id == $volunteerhour->family_id)
                                                    <option value="{{$family->id}}" selected='selected'>{{$family->name}}</option>
                                                @else
                                                    <option value="{{$family->id}}">{{$family->name}}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    @if(!empty($errorList['family id.' . $count]))
                                    <div class="inputError">
                                        {{$errorList['family id.' . $count]}}
                                    </div>    
                                    @endif
                                </td>
                                <td></td>
                                <td><a name="[{{$count}}]" href="#" class="removeEdit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                            </tr>
                        @endif
                    @endforeach
                @endif
            
        </tbody>
</table>
</div>
{{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id)) }}
{{Form::hidden('pageType','volunteer')}}
{{Form::close()}}
@stop
