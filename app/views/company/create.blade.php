@extends('master')

@section('title')
Create Company
@stop

@section('content')
<h1>Create Company</h1>
    <fieldset> 
         <legend>Company Information</legend>  
    <div> 
        {{Form::open(['route' => 'company.store'])}} 
    </div>
    
    <div>
        {{Form::label('company_name', 'Company Name: ')}}
        {{Form::input('text', 'company_name')}}
    </div>
     </fieldset> 
    <div>
     <fieldset> 
         <legend>Contact Information</legend>
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
           </fieldset>
    <div>
        {{Form::submit('Create new Company')}}
    </div>
          </fieldset>
    {{Form::close()}}
@stop