@extends('master')

@section('title')
Create a Contact
@stop

@section('content')
<h1>Create a Contact</h1>
    {{ Form::open(['route' => 'contact.store']) }}
    <!---Hide using Java Script-->
    <div class="companyFields">
        <div>
            <fieldset>
                <legend>Company Information</legend>
                {{Form::label('company_name', 'Company Name: ')}}
                {{Form::input('text', 'company_name')}} 
            </fieldset>
        </div>
    </div>
    <!--------------------------->
    <fieldset>
    <legend>Contact information</legend>
    <div>
        {{ Form::label('first_name', 'First Name: ') }}
        {{ Form::input('text', 'first_name') }}
    </div>
    <div>
        {{ Form::label('last_name', 'Last Name: ') }}
        {{ Form::input('text', 'last_name') }}
    </div>
    <div>
        {{ Form::label('email_address', 'Email Address: ') }}
        {{ Form::input('email', 'email_address') }}
    </div>
    <div>
        {{ Form::label('home_phone', 'Home Phone: ') }}
        {{ Form::input('text', 'home_phone') }}
    </div>
    <div>
        {{ Form::label('cell_phone', 'Cell Phone: ') }}
        {{ Form::input('text', 'cell_phone') }}
    </div>
    <div>
        {{ Form::label('work_phone', 'Work Phone: ') }}
        {{ Form::input('text', 'work_phone') }}
    </div>
    <div>
        {{ Form::label('street_address', 'Street Address: ') }}
        {{ Form::input('text', 'street_address') }}
    </div>
    <div>
        {{ Form::label('city', 'City: ') }}
        {{ Form::input('text', 'city') }}
    </div>
    <div>
        {{ Form::label('province', 'Province: ') }}
        {{ Form::input('text', 'province') }}
    </div>
    <div>
        {{ Form::label('postal_code', 'Postal Code: ') }}
        {{ Form::input('text', 'postal_code') }}
    </div>
    <div>
        {{ Form::label('country', 'Country: ') }}
        {{ Form::input('text', 'country') }}
    </div>
    <div>
        {{ Form::label('comments', 'Comments: ') }}
        {{ Form::input('textarea', 'comments') }}
    </div>
    <div>
        {{Form::label('company_add', 'Add Company: ')}}
        {{Form::checkbox('company_add', true)}}
    </div>
    </fieldset>
    <div>
        {{Form::submit('Create New Contact')}}
    </div>
     
    {{Form::close()}}



@stop