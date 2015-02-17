@extends('master')

@section('title')
Edit Items for Project {{$project->project_name}}
@stop

@section('content')

<h1>Edit Items for {{$project->project_name}}</h1>
{{ Form::open(array('route'=>'updateFormItems','class'=>'form-horizontal')) }}
{{ Form::submit('Save Changes', array('class'=>'btn btn-primary')) }}
<table class="table">
    <thead>
        <tr><th>Item Type</th><th>Manufacturer</th><th>Model</th><th>Serial Number</th><th>Vendor</th><th>Additional Information</th></tr>
    </thead>
    <tbody>
        {{Form::hidden('project_id', $project->id)}}
        
        @if (!empty($projectItems)) 
            @foreach($projectItems as $projectItem)
            <tr class="formrow">
                {{Form::hidden('id[]', $projectItem->id)}}
                <td><select name="item_type[]" class="form-control">
                        @foreach($itemTypes as $itemType)
                            @if ($itemType === $projectItem->item_type)
                                <option selected value="{{$itemType}}">{{$itemType}}</option>
                            @else
                                <option value="{{$itemType}}">{{$itemType}}</option>
                            @endif
                        @endforeach
                </select>
                </td>
                <td>{{Form::input('manufacturer', 'manufacturer[]', $projectItem->manufacturer, array('class'=>'form-control'))}}</td>
                <td>{{Form::input('model', 'model[]', $projectItem->model, array('class'=>'form-control'))}}</td>
                <td>{{Form::input('serial_number', 'serial_number[]', $projectItem->serial_number, array('class'=>'form-control'))}}</td>
                <td>{{Form::input('vendor', 'vendor[]', $projectItem->vendor, array('class'=>'form-control'))}}</td>
                <td>{{Form::input('comments', 'comments[]', $projectItem->comments, array('class'=>'form-control'))}}</td>
                <td><a href="#" class="removeEdit"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>
{{Form::close()}}
{{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
@stop
