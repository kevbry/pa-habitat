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
                {{ Form::select('volunteer',$volunteers);}}
                @foreach($volunteers as $volunteer)
        {{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}
    @endforeach
            </td>  
        </tr>
        
    </tbody>

</table>
{{Form::close()}}
@stop
