@extends('master')

@section('title')
Add Items for Project {{$project->name}}
@stop

@section('content')
<script type="text/html" id="rowtemplate">
    <tr class="formrow">
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
            <td>{{Form::textarea('comments[]',null,array('class'=>'form-control','rows'=>'3'));}}</td>
            <td>{{Form::hidden('project_id[]',$project->id)}}
                <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>  
</script>

<h1>Items for {{$project->name}}</h1>
{{ Form::open(array('route'=>'storeItems','class'=>'form-horizontal')) }}
<a href="#" id="addhours" class="btn btn-primary btn-lg">Add Row</a>
{{Form::submit('Save All',array('class'=>'btn btn-primary btn-lg'))}}
<table class="table">
    <thead>
        <tr><th>Item Type</th><th>Manufacturer</th><th>Model</th><th>Serial Number</th><th>Vendor</th><th>Additional Information</th></tr>
    </thead>
    <tbody>
        <tr class="formrow">
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
            <td>{{Form::textarea('comments[]',null,array('class'=>'form-control','rows'=>'3'));}}</td>
            <td>{{Form::hidden('project_id[]',$project->id)}}
                <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>   
    </tbody>
</table>
{{Form::close()}}
 {{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
@stop
