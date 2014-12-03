@extends('master')

@section('title')
Donor Details
@stop

@section('content')
<h1>Donor details</h1>
<h3>{{ $donor->business_name}}</h3>

 {{ Form::open() }}
 <div>
     {{ Form::label('business_name','Business Name: ') }}
     {{ Form::text('business_name',$donor->business_name) }}
 </div>
 {{ Form::close() }}

 @stop            
