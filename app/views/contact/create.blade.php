@extends('master')

@section('title')
Create a Contact
@stop

@section('content')
<h1>Create a Contact</h1>
    {{ Form::open(['route' => 'contact.store']) }}
    
    <div>
        {{ Form::label('firstName', 'First Name: ') }}
        {{ Form::input('text', 'firstName') }}
    </div>
    <div>
        {{ Form::label('lastName', 'Last Name: ') }}
        {{ Form::input('text', 'lastName') }}
    </div>
    <div>
        {{ Form::label('emailAddress', 'Email Address: ') }}
        {{ Form::input('email', 'emailAddress') }}
    </div>
    <div>
        {{ Form::label('homePhone', 'Home Phone: ') }}
        {{ Form::input('text', 'homePhone') }}
    </div>
    <div>
        {{ Form::label('cellPhone', 'Cell Phone: ') }}
        {{ Form::input('text', 'cellPhone') }}
    </div>
    <div>
        {{ Form::label('workPhone', 'Work Phone: ') }}
        {{ Form::input('text', 'workPhone') }}
    </div>
    <div>
        {{ Form::label('streetNo', 'Street Address: ') }}
        {{ Form::input('text', 'streetNo') }}
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
        {{ Form::label('postalCode', 'Postal Code: ') }}
        {{ Form::input('text', 'postalCode') }}
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
        {{Form::submit('Create New Contact')}}
    </div>
    {{Form::close()}}



@stop