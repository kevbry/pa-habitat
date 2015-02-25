@extends('master')

@section('title')
Create a Contact
@stop

@section('content')
<h1>Create a Contact</h1>
{{ Form::open(array('route'=>'contact.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <div class="form-group">
        {{ Form::label('first_name', 'First Name: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('first_name',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('last_name', 'Last Name: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('last_name',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{Form::label('company_name', 'Company Name:',array('class'=>'col-sm-3'))}}
        <div class="col-sm-7">
        {{Form::text('company_name',null,array('class'=>'form-control'))}}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('email_address', 'Email Address: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('email','email_address',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('home_phone', 'Home Phone: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('home_phone',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('cell_phone', 'Cell Phone: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('cell_phone',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('work_phone', 'Work Phone: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('work_phone',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('street_address', 'Street Address: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('street_address',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('city', 'City: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('city',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('province', 'Province: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('province',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('postal_code', 'Postal Code: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('postal_code',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('country', 'Country: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('country',null,array('class'=>'form-control')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('comments', 'Comments:',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::textarea('comments',null,array('class'=>'form-control')) }}
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