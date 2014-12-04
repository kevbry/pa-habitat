@extends('master')

@section('title')
Create a Contact
@stop

@section('content')
<h1>Create a Contact</h1>
{{ Form::open(array('route'=>'project.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <section class="row text-right">
          <div class="form-group">
            {{Form::submit('Create New Project',array('class'=>'btn btn-primary btn-lg'))}}
        </div>  
    </section>
</section>
</section>
{{Form::close()}}


@stops