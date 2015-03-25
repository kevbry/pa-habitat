@extends('master')

@section('title')
Edit Contact
@stop
@section('content')

<?php
//Define our array of error messages
//Need to set this to the number of inputs you want validated, for
//simplicities sake down the road.
$errorList = array(
    'first name' => '',
    'last name' => '',
    'company' => '',
    'email address' => '',
    'home phone' => '',
    'cell phone' => '',
    'work phone' => '',
    'street address' => '',
    'city' => '',
    'province' => '',
    'postal code' => '',
    'country' => '',
    'comments' => '',
    'safety meeting date' => ''
);
    //If there are errors
if($errors->any())
{
    //For every error
    foreach($errors->all() as $error)
    {
        $counter = 0;
        //For every entry in the "errorList" array
        //This array contains labels for each error, in order to append to
        //The correct fields and allow for scalability.
        foreach($errorList as $errorKey)
        {
            if($counter == 0)
            {
                prev($errorList);
                $counter++;
            }
            //If the error message contains the same field name aka 'first name'
            //Note this is not the field name first_name, this is the name
            //that is used in ContactValidator, or the name that comes up in
            //the actually error message.
            if(strpos($error,key($errorList)) !== FALSE)
            {
                //Add it to the array under the key, so we can use it later.
                $errorList[key($errorList)] = $error;
            }
            var_dump($errorList);
            //Move the key pointer.
            next($errorList);
        }
    }
}
?>

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
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['first name']))
        <div class="inputError">{{$errorList['first name']}}</div>
    @endif
    </div>
</div>
<div class="form-group">
    {{ Form::label('last_name', 'Last Name: ',array('class'=>'col-sm-3')) }}
    <div class="col-sm-7">
    {{ Form::text('last_name',$contact->last_name,array('class'=>'form-control')) }}
    </div>
    <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['last name']))
        <div class="inputError">{{$errorList['last name']}}</div>
    @endif
    </div>
</div>
 <div class="form-group">
     {{ Form::label('email_address','Email: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('email_address',$contact->email_address,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['email address']))
        <div class="inputError">{{$errorList['email address']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('home_phone','Home Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('home_phone',$contact->home_phone,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['home phone']))
        <div class="inputError">{{$errorList['home phone']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('cell_phone','Cell Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('cell_phone',$contact->cell_phone,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['cell phone']))
        <div class="inputError">{{$errorList['cell phone']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('work_phone','Work Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('work_phone',$contact->work_phone,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['work phone']))
        <div class="inputError">{{$errorList['work phone']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('street_address','Street Address: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('street_address',$contact->street_address,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['street address']))
        <div class="inputError">{{$errorList['street address']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('city','City: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('city',$contact->city,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['city']))
        <div class="inputError">{{$errorList['city']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('province','Province: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('province',$contact->province,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['province']))
        <div class="inputError">{{$errorList['province']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('postal_code','Postal Code: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('postal_code',$contact->postal_code,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['postal code']))
        <div class="inputError">{{$errorList['postal code']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('country','Country: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('country',$contact->country,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['country']))
        <div class="inputError">{{$errorList['country']}}</div>
    @endif
    </div>
 </div>
 <div class="form-group">
     {{ Form::label('comments','Comments: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::textarea('comments',$contact->comments,array('class'=>'form-control')) }}
     </div>
     <div class="col-sm-3"></div>
    <div class="col-sm-7">
    @if(!empty($errorList['comments']))
        <div class="inputError">{{$errorList['comments']}}</div>
    @endif
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
        <div class="col-sm-6"></div>
            <div class="col-sm-6">
            @if(!empty($errorList['safety meeting date']))
                <div class="inputError">{{$errorList['safety meeting date']}}</div>
            @endif
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
        <div class="col-sm-6"></div>
            <div class="col-sm-6">
            @if(!empty($errorList['safety meeting date']))
                <div class="inputError">{{$errorList['safety meeting date']}}</div>
            @endif
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

