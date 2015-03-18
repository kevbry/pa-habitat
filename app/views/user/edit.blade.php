@extends('master')

@section('title')
User Details
@stop

@section('content')
{{ Form::open(array('method'=>'PUT','route'=>array('user.update', $user->contact_id), 'class'=>'form-horizontal', 'id'=>'form')) }}
<h1>{{ $user->contact->first_name . " " . $user->contact->last_name . "'s User Details" }}</h1>
<section class="generalInfo col-md-7">

    <!-- <div class="form-group">
     {{ Form::label('username','Username: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('username',$user->username,array('class'=>'form-control')) }}
     </div>
 </div>-->
    
{{Form::hidden('contact_id', $user->contact_id)}}
    
 <div class="form-group">
     {{ Form::label('access_level','Access Level: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
         <select id="access_level" name="access_level" class="form-control">
             <option value="inactive">Inactive</option>
             <option value="basic_user">Basic User</option>
             <option value="contact_manager">Contact Manager</option>
             <option value="project_manager">Project Manager</option>
             <option value="administrator">Administrator</option>
         </select>
     </div>
 </div>
</section>

<section class="row text-right">
    <div class="col-md-5 pull-right">
    {{HTML::linkAction('UserController@show', "Discard Changes", array($user->contact_id), array('class'=>'btn btn-primary btn-lg')) }}
    {{Form::submit('Save Changes',array('class'=>'btn btn-primary btn-lg', 'onclick'=>'confirmExit(false); return false;'))}}
    </div>
</section>
{{ Form::close() }}


<script type="text/javascript">
    $(function()
    {

    });
    
</script>


 @stop            
