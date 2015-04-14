@extends('master')

@section('title')
Edit Volunteer Hours for Project {{$project->id}}
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
<!--Show the project name.-->
<h1>Editing Project Hours for {{$project->name}}</h1>
{{ Form::open(array('route'=> array('updateProjectHours'),'class'=>'form-horizontal')) }}
{{Form::submit('Save All',array('class'=>'btn btn-primary','id'=>'submitEdit'))}}
<br />
<!--If the project has less than 8 rows, don't add the annoying scroll bar.
Otherwise we will add it.-->
@if(count($volunteerhours) > 8)

        <div style="max-height:460px;overflow:scroll;overflow-x:hidden;">
@else

        <div>

@endif

<table class="table">
    <thead style="position: inherit">
        @if (count($volunteerhours) == 0)
            <tr><h3>No hours found for {{$project->name}}</h3></tr>
        @else
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th>
            <th>Project name <span class="hint">?<div class="hiddenHint">Changing this field will move the hour row into another project's hours</div></span></th>
            <th>Family</th></tr>
        @endif
    </thead>
        <tbody>
            <?php
                if(!empty(Input::old()))
                {
                    $existing_rows = Input::old()['row_id'];
                }
            ?>
            {{Form::hidden('proj_id', $project->id)}}
            <!--for every volunteer hour for that project display it.-->
            @if (!empty($volunteerhours)) 
                @foreach($volunteerhours as $volunteerhour)
                
                <?php $count = $volunteerhour->id; ?>
                
                <tr class="formrow">
                     <input id='row_id[]' name='row_id[]' type='hidden' value='{{$volunteerhour->id}}'></input> 
                    <td>                  
                        <select name="volunteer_id[]" class="form-control">
                            @if (!empty($volunteers))
                                @foreach($volunteers as $volunteer)
                                     @if($volunteer->id == $volunteerhour->volunteer_id)
                                     <option selected="selected" value="{{$volunteer->id}}">{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</option>
                                    @else
                                        <option value="{{$volunteer->id}}">{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</option>
                                    @endif
                                @endforeach
                                    @if(!empty($errorList['volunteer id.' . $count]))
                                        <div class="inputError">
                                            {{$errorList['volunteer id.' . $count]}}
                                        </div>
                                    @endif
                            @endif
                        </select>
                    </td>
                    <td>{{Form::number('hours[' . $count . ']', $volunteerhour->hours,array('min'=>0,'class'=>'form-control'))}}
                        @if(!empty($errorList['hours.' . $count]))
                            <div class="inputError">
                                {{$errorList['hours.' . $count]}}
                            </div>
                        @endif
                    </td>
                    
                    <td>{{Form::input('date', 'date_of_contribution[' . $count . ']', $volunteerhour->date_of_contribution, array('class' => 'form-control'))}}
                        @if(!empty($errorList['date of contribution.' . $count]))
                            <div class="inputError">
                                {{$errorList['date of contribution.' . $count]}}
                            </div>
                        @endif
                    </td>
                    <td>
                        @if($volunteerhour->paid_hours == 0)
                            {{Form::select('paid_hours[' . $count . ']', array('0' => 'Volunteer', '1' => 'Paid'),'0', array('min'=>0,'class'=>'form-control'));}}
                        @else
                            {{Form::select('paid_hours[' . $count . ']', array('0' => 'Volunteer', '1' => 'Paid'),'1', array('min'=>0,'class'=>'form-control'));}}
                        @endif
                        @if(!empty($errorList['paid hours.' . $count]))
                            <div class="inputError">
                                {{$errorList['paid hours.' . $count]}}
                            </div>
                        @endif
                    </td>
                    <td>
                        <select name='project_id[{{$count}}]' class="form-control">
                            @if(!empty($projects))
                                @foreach($projects as $projectName)
                                    @if($projectName->id == $volunteerhour->project_id)
                                        <option value="{{$projectName->id}}" selected='selected'>{{$projectName->name}}</option>
                                    @else
                                        <option value="{{$projectName->id}}">{{$projectName->name}}</option>
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
                        <select name='family_id[{{$count}}]' class="form-control">
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
                    <td><a href="#" class="removeEdit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                @endforeach
            @endif
        </tbody>
</table>
</div>
{{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id))}}
{{Form::hidden('pageType','project')}}
{{Form::close()}}
@stop
