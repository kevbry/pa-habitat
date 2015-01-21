@extends('master')

@section('title')
Edit Contact
@stop

@section('content')
<h1>Editing Details</h1>
<h2>{{$contact->first_name . " " . $contact->last_name}}</h2>
{{ Form::open(array('method'=>'PUT','route'=>array('contact.update', $contact->id), 'class'=>'form-horizontal')) }}
<section class="generalInfo col-md-7">

<div class="form-group">
    {{ Form::label('first_name', 'First Name: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
    {{ Form::text('first_name',$contact->first_name,array('class'=>'form-control')) }}
    </div>
</div>
<div class="form-group">
    {{ Form::label('last_name', 'Last Name: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
    {{ Form::text('last_name',$contact->last_name,array('class'=>'form-control')) }}
    </div>
</div>
 <div class="form-group">
     {{ Form::label('email_address','Email: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('email_address',$contact->email_address,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('home_phone','Home Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('home_phone',$contact->home_phone,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('cell_phone','Cell Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('cell_phone',$contact->cell_phone,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('work_phone','Work Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('work_phone',$contact->work_phone,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('street_address','Street Address: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('street_address',$contact->street_address,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('city','City: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('city',$contact->city,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('province','Province: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('province',$contact->province,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('postal_code','Postal Code: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('postal_code',$contact->postal_code,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('country','Country: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('country',$contact->country,array('class'=>'form-control')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('comments','Comments: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::textarea('comments',$contact->comments,array('class'=>'form-control')) }}
     </div>
 </div>
    {{Form::submit('Save Details',array('class'=>'btn btn-primary btn-lg'))}}
</section>

{{ Form::close() }}

 @stop            

