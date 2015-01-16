@extends('master')

@section('title')
Add Volunteer Hours for Project {{$id}}
@stop

@section('content')

<h1>Volunteer Hours</h1>
{{ Form::open(array('route'=>'storehours','class'=>'form-horizontal')) }}
{{Form::submit('Save',array('class'=>'btn btn-primary btn-lg'))}}
<table class="table">
    <thead>
        <tr><th>Name</th><th>Hours</th><th>Date</th><th>Paid Hours</th><th>Project</th><th>Family</th></tr>
    </thead>
    <tbody>
        <tr>
            <td>
                <select name="volunteer_id" class="form-control">
                @foreach($volunteers as $volunteer)
                    <option value="{{$volunteer->id}}">{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</option>
                @endforeach
                </select>
            </td>  
            <td>{{Form::number('hours', '0',array('min'=>0,'class'=>'form-control'))}}</td>
            <td>{{Form::input('date', 'date_of_contribution', null, array('class' => 'form-control', 'placeholder' => 'Date'))}}</td>
            <td>{{Form::checkbox('paid_hours', 'paid')}}</td>
            <td>
                <select name="project_id" class="form-control">
                @foreach($projects as $project)
                    <option value="{{$project->id}}">{{$project->name}}</option>
                @endforeach
                </select>
            </td>
            <td>
                TODO ADD FAMILY DROP DOWN HERE
            </td>
        </tr>
        
    </tbody>

</table>
{{Form::close()}}
@stop
