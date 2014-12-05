@extends('master')

@section('title')
Create a Project
@stop

@section('content')
<h1>Create a Project</h1>
{{ Form::open(array('route'=>'project.store','class'=>'form-horizontal')) }}
<section class="row">
<section class="col-md-7">
    <div class="form-group">
        {{ Form::label('name', 'Project Name: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('name',"House 106",array('class'=>'form-control')) }}
        </div>
    </div>
</section>
</section>
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


@stop