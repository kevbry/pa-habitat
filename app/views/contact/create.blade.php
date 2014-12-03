@extends('master')

@section('title')
Create a Contact
@stop

@section('content')
<h1>Create a Contact</h1>
<section class="col-md-7">
    {{ Form::open(array('route'=>'contact.store','class'=>'form-horizontal')) }}
    
    <!---Hide using Java Script-->
    <div class="companyFields">
        <div>
            <fieldset>
                <legend>Company Information</legend>
                {{Form::label('company_name', 'Company Name: ')}}
                {{Form::input('text', 'company_name')}} 
            </fieldset>
    <!--------------------------->
    <legend>Contact information</legend>
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
        {{ Form::label('comments', 'Comments: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::textarea('comments',null,array('class'=>'form-control')) }}
        </div>
    </div>

    <div class="form-group">
        {{Form::label('is_volunteer', 'Is a Volunteer',array('class'=>'col-sm-3'))}}
        <div class="col-sm-7">
        {{Form::checkbox('is_volunteer',true)}}
        </div>
    </div>
    <div>
    <div>
        {{Form::label('company_add', 'Add Company: ')}}
        {{Form::checkbox('company_add', true)}}
    
    <!-- TODO: Make this stuff disappear with JavaScript -->
    <div class="volunteerFields">
        <div class="form-group">
            {{Form::label('active_status', 'Current Volunteer Status: ',array('class'=>'col-sm-3'))}}
            <div class="col-sm-7">
            {{Form::input('checkbox', 'active_status')}}
            </div>
        </div>
        <div class="form-group">
            {{Form::label('safety_status', 'Last Attended Safety Meeting: ',array('class'=>'col-sm-3'))}}
            <div class="col-sm-7">
            {{Form::input('date', 'safety_status',null,array('class'=>'form-control'))}}
            </div>
        </div>
    </div>
    
    <div class="form-group">
        {{Form::submit('Create New Contact',array('class'=>'btn btn-primary btn-lg'))}}
    </div>
     
    {{Form::close()}}
</section>


@stop