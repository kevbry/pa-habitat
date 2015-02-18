@extends('master')

@section('title')
Edit Volunteer Hours for Project {{$project->id}}
@stop

@section('content')

<h1>Editing Project Hours for {{$project->name}}</h1>
{{ Form::open(array('route'=> array('updateProjectHours'),'class'=>'form-horizontal')) }}
{{Form::submit('Save All',array('class'=>'btn btn-primary','id'=>'submitEdit'))}}
<br />

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
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th><th>Project name<span id="namehelp" title="help">        ?</span></th><th>Family</th></tr>
        @endif
    </thead>
        <tbody>
            {{Form::hidden('proj_id', $project->id)}}
            @if (!empty($volunteerhours)) 
                @foreach($volunteerhours as $volunteerhour)
                <tr class="formrow">
                    <td>
                        @foreach($volunteers as $volunteer)
                            {{Form::hidden('volunteer_id[]', $volunteer->id)}}
                        @endforeach
                                                        
                        <select name="volunteer_id[]" class="form-control">
                            @if (!empty($volunteers))
                                @foreach($volunteers as $volunteer)
                                    <option value="{{$volunteer->id}}">{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</option>
                                @endforeach
                            @endif
                        </select>
                    </td>
                    <td>{{Form::number('hours[]', $volunteerhour->hours,array('min'=>0,'class'=>'form-control'))}}</td>
                    <td>{{Form::input('date', 'date_of_contribution[]', $volunteerhour->date_of_contribution, array('class' => 'form-control'))}}</td>
                    <td>
                        @if($volunteerhour->paid_hours == 0)
                            {{Form::select('paid_hours[]', array('0' => 'Volunteer', '1' => 'Paid'),'0', array('min'=>0,'class'=>'form-control'));}}
                        @else
                            {{Form::select('paid_hours[]', array('0' => 'Volunteer', '1' => 'Paid'),'1', array('min'=>0,'class'=>'form-control'));}}
                        @endif
                    </td>
                    <td>
                        <select name="project_id[]" class="form-control">
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
                    </td>
                    <td>
                        <select name="family_id[]" class="form-control">
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
