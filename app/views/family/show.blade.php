@extends('master')

@section('title')
Family Details
@stop

<?php
// Retrieve the base URL for linking to other parts of the project
$rootPageURL = explode('family', $_SERVER['HTTP_REFERER']);
?>



@section('content')
<h1>Family details</h1>
<h2>{{$family[0]->name}}</h2>
<section class="row">
<section class="col-md-7">
    @foreach($family[1] as $contact)
        <?php $contactLabel = $contact->primary ? "Primary Contact: " : "Secondary Contact: ";  ?>
        <div class="form-group">
            {{ Form::label('contact_name',$contactLabel ,array('class'=>'col-sm-4')) }}
            <div class="col-sm-6">
            {{ Form::label('contact_name',$contact->first_name . ' ' . $contact->last_name,array('class'=>'col-sm-7')) }}
            </div>
            <p><a href="{{$rootPageURL[0] . "contact/" . $contact->id}}">View Details</a></p>
        </div>
    @endforeach
</section>
</section>
@stop            
