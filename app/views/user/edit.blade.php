@extends('master')

@section('title')
User Details
@stop

@section('content')
@if(!empty($user))
{{ Form::open(array('method'=>'PUT','route'=>array('user.update', $user->contact_id), 'class'=>'form-horizontal', 'id'=>'form')) }}
<h1>{{ $user->contact->first_name . " " . $user->contact->last_name . "'s User Details" }}</h1>
<div class="inputError">
    <?php foreach($errors->all() as $error=>$message){printf($message . "<br />");} ?>
</div>
<section class="row generalInfo col-md-7">
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
             <option value="inactive" <?php echo($user->access_level === 'inactive' ? "selected" : ""); ?>>Inactive</option>
             <option value="basic_user" <?php echo($user->access_level === 'basic_user' ? "selected" : ""); ?>>Basic User</option>
             <option value="contact_manager" <?php echo($user->access_level === 'contact_manager' ? "selected" : ""); ?>>Contact Manager</option>
             <option value="project_manager" <?php echo($user->access_level === 'project_manager' ? "selected" : ""); ?>>Project Manager</option>
             <option value="administrator" <?php echo($user->access_level === 'administrator' ? "selected" : ""); ?>>Administrator</option>
         </select>
     </div>
     
 </div>

<div class="form-group">
    {{ Form::label('password', 'Password: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
    {{ Form::input('password', 'password',null,array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('confirm_password', 'Confirm Password: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
    {{ Form::input('password', 'confirm_password',null,array('class'=>'form-control')) }}
    </div>
</div>
</section>

<section class="row  text-right">
    <div class="col-md-12 pull-right">
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

@endif
 @stop            
