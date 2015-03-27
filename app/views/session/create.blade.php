@extends('master')

@section('title')
Login
@stop

@section('content')

    @if (Session::has('login_errors'))
      <span class="error">Username or password incorrect.</span>
    @endif
    <h1>Login</h1>
    {{ Form::open(array('route' => 'session.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <div class="form-group">
      {{ Form::label('username', 'Username',array('class'=>'col-sm-3')) }}
      <div class="col-sm-7">
      {{ Form::text('username',null,array('class'=>'form-control')) }}
      </div>
    </div>
    
    <div class="form-group">
      {{ Form::label('password', 'Password',array('class'=>'col-sm-3')) }}
          <div class="col-sm-7">
      {{ Form::input('password', 'password',null,array('class'=>'form-control')) }}
          </div>
    </div>
</section>
</section>
    <section class="row text-right">
        <div class="col-md-5 pull-right">
      {{ Form::submit('Login',array('class'=>'btn btn-primary btn-lg')) }}
        </div>
    </section>
    {{ Form::close() }}

@stop