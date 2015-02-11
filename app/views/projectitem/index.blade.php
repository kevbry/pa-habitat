@extends('master')

@section('title')
Items for Project {{$project->project_name}}
@stop

@section('content')

<h1>Items for {{$project->project_name}}</h1>
{{ HTML::linkRoute('projItemsAdd', 'Add Items', array($project->id), array('class' => 'btn btn-primary')) }}
{{ Form::open(array('route'=>'storeItems','class'=>'form-horizontal')) }}
<table class="table">
    <thead>
        <tr><th>Item Type</th><th>Manufacturer</th><th>Model</th><th>Serial Number</th><th>Vendor</th><th>Additional Information</th></tr>
    </thead>
    <tbody>
        @if (!empty($projectItems)) 
            @foreach($projectItems as $projectItem)
            <tr>
                <td>{{$projectItem->item_type}}</td>
                <td>{{$projectItem->manufacturer}}</td>
                <td>{{$projectItem->model}}</td>
                <td>{{$projectItem->serial_number}}</td>
                <td>{{$projectItem->vendor}}</td>
                <td>{{$projectItem->comments}}</td>
                <td></td>
            </tr>
            @endforeach
        @endif
    </tbody>
</table>

{{Form::close()}}
{{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
<?php 
if (!empty($projectItems))
{
    echo $projectItems->links();
}
 ?>
@stop
