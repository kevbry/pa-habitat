@extends('master')

@section('title')
Edit Contact
@stop
    @if($errors->any())
    <h1>{{$errors->first()}}</h1>
    @endif
@section('content')
<h2>Editing Details for {{$contact->first_name . " " . $contact->last_name}}</h2>
<h2></h2>
{{ Form::open(array('method'=>'PUT','route'=>array('contact.update', $contact->id), 'class'=>'form-horizontal', 'id'=>'form')) }}
<section class="row">
<section class="generalInfo col-md-7">
<h3>Contact Details</h3>
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

</section>
 <?php
    $volunteerStatus = 0;
    $volunteerSafetyDate = "";
    //If the volunteer exists
    if( $volunteer )
    {
        //Show the active status and last safety meeting
        $volunteerStatus = $volunteer->active_status;
        $volunteerSafetyDate = $volunteer->last_attended_safety_meeting_date;
    }
    //If the status is 1 it's active otherwise no.
    if ($volunteerStatus === 1) {
        $volunteerStatus = 'Active';
    }
    elseif ($volunteerStatus === 0){
        $volunteerStatus = 'Inactive';
    }
 ?>
 <?php
    $volunteerSafetyDate = "";
    
    if( $volunteer )
    {
        $volunteerSafetyDate = $volunteer->last_attended_safety_meeting_date;
    }
 ?>
<section class='volunteerFields col-md-5'>
    <h3>Volunteer Details</h3>
@if (!$volunteer)
    <div class="form-group">
        {{Form::label('is_volunteer', 'Is a Volunteer:',array('class'=>'col-sm-6'))}}
        <div class="col-sm-6">
        {{Form::checkbox('is_volunteer',true)}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('active_status', 'Is Volunteer Active: ',array('class'=>'col-sm-6'))}}
        <div class="col-sm-6">
        {{Form::input('checkbox', 'active_status',null)}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('last_attended_safety_meeting_date', 'Last Attended Safety Meeting: ',array('class'=>'col-sm-6'))}}
        <div class="col-sm-6">
        {{Form::input('date', 'last_attended_safety_meeting_date',null,array('class'=>'form-control'))}}
        </div>
    </div>
@else
    <div class="form-group">
        {{Form::label('active_status', 'Is Volunteer Active: ',array('class'=>'col-sm-6'))}}
        <div class="col-sm-6">
        {{Form::input('checkbox', 'active_status', $volunteer->active_status, $volunteer->active_status ? array('checked') : array(''))}}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('last_attended_safety_meeting_date', 'Last Attended Safety Meeting: ',array('class'=>'col-sm-6'))}}
        <div class="col-sm-6">
        {{Form::input('date', 'last_attended_safety_meeting_date',$volunteerSafetyDate,array('class'=>'form-control'))}}
        </div>
    </div>
@endif
 </section>
</section>
<section class="row text-right">
    <div class="col-md-5 pull-right">
            {{HTML::linkAction('ContactController@show', "Discard Changes", array($contact->id), array('class'=>'btn btn-primary btn-lg')) }}
    {{Form::submit('Save Changes',array('class'=>'btn btn-primary btn-lg', 'onclick'=>'confirmExit(false); return false;'))}}
    </div>
</section>

{{ Form::close() }}

 @stop            

