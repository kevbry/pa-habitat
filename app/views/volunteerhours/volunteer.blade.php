@extends('master')

@section('title')
Add Volunteer Hours for Volunteer {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}
@stop

@section('content')

<h1>Volunteer Hours for {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}</h1>
{{ Form::open(array('route'=>'storehours','class'=>'form-horizontal')) }}

 {{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id), array('class'=>'btn btn-primary btn-lg')) }}
 {{ HTML::linkAction('VolunteerHoursController@indexForEditContact','Edit', array($volunteer->id), array('class'=>'btn btn-primary btn-lg')) }}
<table class="table">
    <thead>
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Hour type</th><th>Project</th><th>Family</th></tr>
    </thead>
    <tbody>
        @if (!empty($volunteerhours)) 
            @foreach($volunteerhours as $volunteerhour)
            <tr>
                <td>{{$volunteerhour->volunteer->contact->first_name . ' ' . $volunteerhour->volunteer->contact->last_name}}</td>
                <td>{{$volunteerhour->hours}}</td>
                <td>{{$volunteerhour->date_of_contribution}}</td>
                <td>
                @if($volunteerhour->paid_hours == 0)
                    Volunteer
                 @else
                     Paid
                 @endif
                </td>
                <td>{{$volunteerhour->project->name}}</td>
                <td>
                @if(isset($volunteerhour->family->name))
                {{$volunteerhour->family->name}}
                @else
                --
                @endif</td>
                <td></td>
            </tr>
            @endforeach
        @endif
        <tr class="hourrow">
            <td>
                <select name="volunteer_id[]" class="form-control">
            
                    <option value="{{$volunteer->id}}">{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</option>
             
           
                </select>
            </td>  
            <td>{{Form::number('hours[]', '0',array('min'=>0,'class'=>'form-control'))}}</td>
            <td>{{Form::input('date', 'date_of_contribution[]', null, array('class' => 'form-control', 'placeholder' => 'Date'))}}</td>
            <td>{{Form::select('paid_hours[]', array('0' => 'Volunteer', '1' => 'Paid'), '', array('min'=>0,'class'=>'form-control'));}}</td>
            <td>
                <select name="project_id[]" class="form-control">
                    @if(!empty($projects))
                        @foreach($projects as $project)
                            <option value="{{$project->id}}">{{$project->name}}</option>
                        @endforeach
                    @endif
                </select>
            </td>
            <td>
                <select name="family_id[]" class="form-control">
                    <option value="0" selected>--</option>
                @if (!empty($families))
                @foreach($families as $family)
                    <option value="{{$family->id}}">{{$family->name}}</option>
                @endforeach
                @endif
                </select>
            </td>
            <td><a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>   
    </tbody>
</table>
<a href="#" id="addhours" class="btn btn-primary btn-lg">Add Row</a>
{{Form::submit('Save All',array('class'=>'btn btn-primary btn-lg'))}}
{{Form::hidden('pageType','volunteer')}}
{{Form::close()}}
@stop
