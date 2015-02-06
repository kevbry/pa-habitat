@extends('master')

@section('title')
Add Items for Project {{$project->project_name}}
@stop

@section('content')

<h1>Items for {{$project->project_name}}</h1>
{{ Form::open(array('route'=>'storeItems','class'=>'form-horizontal')) }}
<a href="#" id="addhours" class="btn btn-primary btn-lg">Add Row</a>
{{Form::submit('Save All',array('class'=>'btn btn-primary btn-lg'))}}
<table class="table">
    <thead>
        <tr><th>Item Type</th><th>Manufacturer</th><th>Model</th><th>Serial Number</th><th>Vendor</th><th>Comments</th></tr>
    </thead>
    <tbody>
        <tr class="hourrow">
            <td>
                <select name="item_type[]" class="form-control">
            @if (!empty($itemTypes))
                @foreach($itemTypes as $itemType)
                    <option value="{{$itemType}}">{{$itemType}}</option>
                @endforeach
            @endif
                </select>
            </td>  
            <td>{{Form::text('manufacturer[]', null, array('class' => 'form-control'))}}</td>
            <td>{{Form::text('model[]', null, array('class'=>'form-control'));}}</td>
            <td>{{Form::text('serial_number[]',null,array('class'=>'form-control'));}}</td>
            <td>{{Form::text('vendor[]',null,array('class'=>'form-control'));}}</td>
            <td>{{Form::textarea('comments[]',null,array('class'=>'form-control'));}}</td>
            <td>{{Form::hidden('project_id',$project->id)}}
                <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>   
    </tbody>
</table>
{{Form::close()}}
 {{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
@stop
