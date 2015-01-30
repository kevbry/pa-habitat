@extends('master')

@section('title')
Add Volunteer Hours for Volunteer {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}
@stop

@section('content')

<h1>Volunteer Hours for {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}</h1>
{{ Form::open(array('route'=>'updatehours','class'=>'form-horizontal')) }}

 {{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id), array('class'=>'btn btn-primary btn-lg')) }}
<br />
<div style="max-height:500px;overflow:scroll;overflow-x:hidden;">
<table class="table">
    <thead style="position: inherit">
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th><th>Project</th><th>Family</th></tr>
    </thead>
        <tbody>
            @if (!empty($volunteerhours)) 
                @foreach($volunteerhours as $volunteerhour)
                <tr class="hourrow">
                    <td>
                        <!--<select name="volunteer_id[]" class="form-control" readonly='readonly'>
                            <option value="{{$volunteer->id}}">{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</option>
                        </select>-->
                        {{Form::hidden('volunteer_id[]', $volunteer->id)}}
                        {{Form::input('name', 'volunteer_name', $volunteer->contact->first_name . ' ' . $volunteer->contact->last_name, 
                                    array('readonly'=>'readonly', 'class'=>'form-control'))}}
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
                                @foreach($projects as $project)
                                    @if($project->id == $volunteerhour->project_id)
                                        <option value="{{$project->id}}" selected='selected'>{{$project->name}}</option>
                                    @else
                                        <option value="{{$project->id}}">{{$project->name}}</option>
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
                    <td><a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
                </tr>
                @endforeach
            @endif
        </tbody>
</table>
</div>
 <br />
{{Form::submit('Save All',array('class'=>'btn btn-primary btn-lg'))}}
{{Form::hidden('pageType','volunteer')}}
{{Form::close()}}
@stop
