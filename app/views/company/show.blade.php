@extends('master')

@section('title')
Company Details
@stop


@section('content')
<h1>Company Details</h1>
<h3>{{$company->company_name}}</h3>

{{Form::open()}}
<div>
    {{Form::label(company_)}}
</div>
