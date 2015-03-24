@extends('master')

@section('title')
Home
@stop

@section('content')
<h2>Welcome {{Session::get('username')}} to the Habitat for Humanity Contact and Project Management System</h2>
<p>Please select an option from the navigation bar above.</p>

@stop            
