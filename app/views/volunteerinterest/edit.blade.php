@extends('master')

@section('title')
Interests for {{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name }} 
@stop

@section('content')

<h1>Interests for {{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name }} </h1> 

{{ Form::open(array('route'=>'updateInterests','class'=>'form-horizontal')) }}
{{ Form::submit('Save Changes', array('class'=>'btn btn-primary')) }}
{{Form::hidden('contact', $volunteer->id)}}     
<table class="table">
    <thead>
        <tr><th>Interest</th><th>Comment</th></tr>
    </thead>
    <tbody>
       @if (!empty($volunteerInterests)) 
            @foreach($volunteerInterests as $volInterest)
            <tr class="formrow">

                 {{Form::hidden('row_id[]', $volInterest->id)}}            
                <td><select name="interest[]" class="form-control">
                        @foreach($interests as $interest)
                            @if ($interest->id === $volInterest->interest_id)
                                <option selected value="{{$interest->id}}">{{$interest->description}}</option>
                            @else
                                <option value="{{$interest->id}}">{{$interest->description}}</option>
                            @endif
                        @endforeach
                </select>
                </td>
                <td>{{Form::input('comments', 'comments[]', $volInterest->comments, array('class'=>'form-control'))}}</td>
                <td>{{Form::hidden('volunteer_id[]',$volunteer->id)}}
                <a href="#" class="removeEdit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{Form::close()}}
{{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id)) }}
<?php 
//if (!empty($volunteerInterests))
//{
//    echo $volunteerInterests->links();
//}
// ?>
@stop
