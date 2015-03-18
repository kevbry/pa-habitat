@extends('master')

@section('title')
Items for Project {{$volunteer->volunteer_name}}
@stop

@section('content')

<h1>Interests for {{$volunteer->name}}</h1> 
{{ HTML::linkRoute('editFormForInterests', 'Edit Interests', array($volunteer->id), array('class' => 'btn btn-primary')) }}
{{ Form::open(array('route'=>'storeInterests','class'=>'form-horizontal')) }}
<table class="table">
    <thead>
        <tr><th>Interest</th><th>Comment</th></tr>
    </thead>
    <tbody>
       @if (!empty($volunteerInterests)) 
            @foreach($volunteerInterests as $volInterest)
            <tr class="formrow">
                {{Form::hidden('id[]', $volInterest->interest_id)}}
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
                <td><a href="#" class="removeEdit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{Form::close()}}
{{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id)) }}
<?php 
if (!empty($volunteerInterests))
{
    echo $volunteerInterests->links();
}
 ?>
@stop
