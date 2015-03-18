@extends('master')

@section('title')
User Details
@stop

@section('content')

{{ Form::open(array('class'=>'form-horizontal')) }}
<h1>{{ $user->contact->first_name . " " . $user->contact->last_name . "'s User Details" }}</h1>
    <a href="contact/{{$user->contact_id}}" class="btn btn-primary">View Contact Details</a>
<section class="generalInfo col-md-7">

    <!-- <div class="form-group">
     {{ Form::label('username','Username: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('username',$user->username,array('class'=>'form-control')) }}
     </div>
 </div>-->

 <div class="form-group">
     {{ Form::label('access_level','Access Level: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
         <select name="access_level" class="form-control">
             <option value="inactive">Inactive</option>
             <option value="basic_user">Basic User</option>
             <option value="contact_manager">Contact Manager</option>
             <option value="project_manager">Project Manager</option>
             <option value="administrator">Administrator</option>
         </select>
     </div>
 </div>
</section>
{{ Form::close() }}

 @stop            
