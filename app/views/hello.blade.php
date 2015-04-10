@extends('master')

@section('title')
Home
@stop

@section('content')
<h2>Welcome {{Session::get('username')}} to the Habitat for Humanity Contact and Project Management System</h2>
@if (Auth::check() && (Session::get('access_level') === 'inactive' ))
<p>Your account has been set to inactive. Please contact an administrator.</p>
@else
<p>Please select an option from the navigation bar above.</p>
@endif

@stop            
