@extends('master')

@section('title')
Company Details
@stop

@section('content')
<h1>Company details</h1>
<h2>{{ $company->company_name }}</h2>
<table class="table table-hover">
    <thead>
        <tr><th>Main Contact</th><th></th></tr>
    </thead>
    <tr>
        <td>{{$company->mainContact->first_name}} {{$company->mainContact->last_name}}</td>
        <td>{{ HTML::linkAction('ContactController@show', 'View Details', $company->mainContact->id)}} / 
            {{ HTML::linkAction('ContactController@edit','Edit Details', $company->mainContact->id)}}</td>
    </tr>
</table>
@stop            
