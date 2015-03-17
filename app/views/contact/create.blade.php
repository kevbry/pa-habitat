@extends('master')

@section('title')
Create a Contact
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
    'comments' => ''
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
            if(strpos($error,key($errorList)) !== FALSE)
            {
                //Add it to the array under the key, so we can use it later.
                $errorList[key($errorList)] = $error;
            }
            //Move the key pointer.
            next($errorList);
        }
    }
}



?>

<h1>Create a Contact</h1>
{{ Form::open(array('route'=>'contact.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <div class="form-group">
        {{ Form::label('first_name', 'First Name: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('first_name',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['first name']))
            <div class="inputError">{{$errorList['first name']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('last_name', 'Last Name: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('last_name',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['last name']))
            <div class="inputError">{{$errorList['last name']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{Form::label('company_name', 'Company Name:',array('class'=>'col-sm-3'))}}
        <div class="col-sm-7">
        {{Form::text('company_name',null,array('class'=>'form-control'))}}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['company name']))
            <div class="inputError">{{$errorList['company name']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('email_address', 'Email Address: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('email','email_address',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['email address']))
            <div class="inputError">{{$errorList['email address']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('home_phone', 'Home Phone: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('home_phone',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['home phone']))
            <div class="inputError">{{$errorList['home phone']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('cell_phone', 'Cell Phone: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('cell_phone',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['cell phone']))
            <div class="inputError">{{$errorList['cell phone']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('work_phone', 'Work Phone: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('work_phone',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['work phone']))
            <div class="inputError">{{$errorList['work phone']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('street_address', 'Street Address: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('street_address',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['street address']))
            <div class="inputError">{{$errorList['street address']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('city', 'City: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('city',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['city']))
            <div class="inputError">{{$errorList['city']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('province', 'Province: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('province',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['province']))
            <div class="inputError">{{$errorList['province']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('postal_code', 'Postal Code: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('postal_code',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['postal code']))
            <div class="inputError">{{$errorList['postal code']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('country', 'Country: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('country',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['country']))
            <div class="inputError">{{$errorList['country']}}</div>
        @endif
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('comments', 'Comments:',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::textarea('comments',null,array('class'=>'form-control')) }}
        </div>
        <div class="col-sm-7">
        @if(!empty($errorList['comments']))
            <div class="inputError">{{$errorList['comments']}}</div>
        @endif
        </div>
    </div>
</section>
<section class="col-md-5">
        <div class="form-group">
        {{Form::label('is_volunteer', 'Is a Volunteer:',array('class'=>'col-sm-6'))}}
        <div class="col-sm-6">
        {{Form::checkbox('is_volunteer',true)}}
        </div>
    </div>
    <!-- TODO: Make this stuff disappear with JavaScript -->

        <div class="form-group">
            {{Form::label('active_status', 'Is Volunteer Active: ',array('class'=>'col-sm-6'))}}
            <div class="col-sm-6">
            {{Form::input('checkbox', 'active_status')}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('last_attended_safety_meeting_date', 'Last Attended Safety Meeting: ',array('class'=>'col-sm-6'))}}
            <div class="col-sm-6">
            {{Form::input('date', 'last_attended_safety_meeting_date',null,array('class'=>'form-control'))}}
            </div>
        </div>

    <div class="form-group">
        {{Form::label('is_donor', 'Is a Donor:',array('class'=>'col-sm-6'))}}
        <div class="col-sm-6">
        {{Form::checkbox('is_donor', true)}}
        </div>
    </div>
</section>
</section>
<section class="row text-right">
    <div class="col-md-5 pull-right">
        {{Form::submit('Save New Contact',array('class'=>'btn btn-primary btn-lg'))}}
    </div>
</section>

{{Form::close()}}


@stop