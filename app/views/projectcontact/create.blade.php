@extends('master')

@section('title')
@if (!empty($project))
Add Contacts for Project {{$project->name}}
@endif
@stop

@section('content')
<script type="text/html" id="rowtemplate">
        <tr class="formrow">
            <td>
                <select name="contact_id[]" class="form-control">
            @if (!empty($contacts))
                @foreach($contacts as $contact)
                    <option value="{{$contact->id}}">{{$contact->first_name . ' ' . $contact->last_name}}</option>
                @endforeach
            @endif
                </select>
            </td>
            <td>
                <select name="role_id[]" class="form-control">
                @if (!empty($roles))
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->role}}</option>
                    @endforeach
                @endif
                </select>
            </td>
            <td>{{Form::textarea('notes[]',null,array('class'=>'form-control', 'rows'=>3));}}</td>
            @if (!empty($project))
            <td>{{Form::hidden('project_id',$project->id)}}
                @endif
                <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr>
</script>
@if (!empty($project))
<h1>Contacts for {{$project->name}}</h1>
@endif
{{ Form::open(array('route'=>'projStoreContacts','class'=>'form-horizontal')) }}
<a href="#" id="addhours" class="btn btn-primary">Add Row</a>
{{Form::submit('Save All',array('class'=>'btn btn-primary'))}}
<table class="table">
    <thead>
        <tr><th>Name</th><th>Role</th><th>Notes</th></tr>
    </thead>
    <tbody>
        <tr class="formrow">
            <td>
                <select name="contact_id[]" class="form-control">
            @if (!empty($contacts))
                @foreach($contacts as $contact)
                    <option value="{{$contact->id}}">{{$contact->first_name . ' ' . $contact->last_name}}</option>
                @endforeach
            @endif
                </select>
            </td>
            <td>
                <select name="role_id[]" class="form-control">
                @if (!empty($roles))
                    @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->role}}</option>
                    @endforeach
                @endif
                </select>
            </td>
            <td>{{Form::textarea('notes[]',null,array('class'=>'form-control', 'rows'=>3));}}</td>
            @if (!empty($project))
            <td>{{Form::hidden('project_id',$project->id)}}
                @endif
                <a href="#" class="remove"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td>
        </tr> 
    </tbody>
</table>
{{Form::close()}}
@if (!empty($project))
 {{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
 @endif
@stop

