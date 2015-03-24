@extends('master')

@section('title')
Interests for {{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name }} 
@stop

@section('content')
 
<script type="text/html" id="rowtemplate">
    <tr class="formrow">

        <td><select name="interest[]" class="form-control">
                @foreach($interests as $interest)
                 @if( !in_array($interest->id ,$interestList))
                <option value="{{$interest->id}}">{{$interest->description}}</option>
                @endif
                @endforeach
            </select>
        </td>
        <td>{{Form::input('comments', 'comments[]',null, array('class'=>'form-control'))}}</td>
        <td>{{Form::hidden('volunteer_id[]',$volunteer->id)}}
            <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
    </tr>
</script>

<h1>Interests for {{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name }} </h1> 
{{ Form::open(array('route'=>'storeInterests','class'=>'form-horizontal')) }}
<a href="#" id="addhours" class="btn btn-primary btn-lg">Add Row</a>
{{Form::submit('Save All',array('class'=>'btn btn-primary btn-lg'))}}
<table class="table">
    <thead>
        <tr><th>Interest</th><th>Comment</th></tr>
    </thead>
    <tbody>
        <tr class="formrow">

            <td><select name="interest[]" class="form-control col-sm-6">
                    @foreach($interests as $interest)

                    @if( !in_array($interest->id ,$interestList))
                    <option value="{{$interest->id}}">{{$interest->description}}</option>
                    @endif

                    @endforeach
                </select>
            </td>

            <td>{{Form::input('comments', 'comments[]', null, array('class'=>'form-control'))}}</td>
            <td>{{Form::hidden('volunteer_id[]',$volunteer->id)}}
                <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>
    </tbody>
</table>
{{Form::close()}}
{{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id)) }}
@stop
