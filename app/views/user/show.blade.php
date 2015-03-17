@extends('master')

@section('title')
User Details
@stop

@section('content')

{{ Form::open(array('class'=>'form-horizontal')) }}
<h1>{{ $user->contact->first_name . " " . $user->contact->last_name . "'s User Details" }}</h1>
    <a href="{{$user->contact_id}}/edit" class="btn btn-primary">Edit Details</a>
    {{ HTML::linkAction('ContactController@show','View Contact Details', $user->contact_id) }}
<section class="generalInfo col-md-7">
 <div class="form-group">
     {{ Form::label('username','Username: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('username',$user->username,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('email_address','Email: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('email_address',$user->contact->email_address,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('access_level','Access Level: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('access_level',$user->access_level,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
</section>
{{ Form::close() }}

 @stop            
