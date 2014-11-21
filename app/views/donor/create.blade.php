@extends('donor.donormaster')

@section('title')
Create a Donor
@stop

@section('content')
<h1>Create a Donor</h1>
    {{ Form::open(['route' => 'donor.store']) }}
    
    <div>
        {{ Form::label('business_name', 'Business Name: ') }}
        {{ Form::input('text', 'business_name') }}
    </div>
    <div>
        {{Form::submit('Create New Donor')}}
    </div>
    {{Form::close()}}

@stop