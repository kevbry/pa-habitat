@extends('master')

@section('title')
Company Details
@stop

@section('content')
<h1>Company details</h1>
<h2>{{ $company->name }}</h2>
<table class="table table-hover">
    <thead>
        <tr><th>Main Contact</th><th></th></tr>
    </thead>
    <tr>
        <td>{{$company->mainContact->first_name}} {{$company->mainContact->last_name}}</td>
        <td>{{ HTML::linkAction('ContactController@show', 'View Details', $company->mainContact->id)}} 
            @if (Auth::check() && (Session::get('access_level') !== 'basic_user' ))
             / {{ HTML::linkAction('ContactController@edit','Edit Details', $company->mainContact->id)}}</td>
            @endif
    </tr>
</table>
@stop            
