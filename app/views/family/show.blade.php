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
<h3>Status: {{$family[0]->status}} (xxx Hours Remaining/Contributed)</h3>
<h4>Active Contacts</h4>
<section class="row">
<section class="col-md-7">
    <table class="table table-hover">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Hours Contributed</th>
                <th></th>
            </tr>
        </thead>
<!--        <tfoot>
            <tr>
                <td></td>
                <td>Total Primary Hours:</td>
                <td>Hours Go Here</td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td>Total Secondary Hours:</td>
                <td>Hours Go Here</td>
                <td></td>
            </tr>            
            <tr>
                <td></td>
                <td>Total Family Hours:</td>
                <td>Hours Go Here</td>
                <td></td>
            </tr>
            
        </tfoot>-->
        <tbody>    
        @foreach($family[1] as $contact)
            <?php $contactType = $contact->primary ? "Primary" : "Secondary";  ?>
            <tr>
                <td>{{$contact->first_name . ' ' . $contact->last_name}}</td>
                <td>{{$contactType}}</td>
                <td>{{Form::label('contact_total_hours', 'XXX', array('class'=>'col-sm-7'))}}</td>
                <td><a href="{{$rootPageURL[0] . "contact/" . $contact->id}}">View Details</a></td>
            </tr>
        @endforeach    
        </tbody>
    </table>
    <div>
        <div><p>Total Primary Hours: <span>XXX</span></p></div>
        <div><p>Total Secondary Hours: <span>XXX</span></p></div>
        <div><p>Total Family Hours: <span>XXX</span></p></div>
    </div>

</section>
</section>
<div class="form-group row">

    <!-- Granular information table (detailed breakdown) -->
<!--        <h4>Contributed Hours</h4>
        <table class="table table-hover">
        <thead>
            <tr>
                <th>Contact</th>
                <th>Project</th>
                <th>Date</th>
                <th>Hours</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <td></td>
            <td></td>
            <td>Sub Total (Primary Contacts):</td>
            <td>Total Hours Here</td>                
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Sub Total (Secondary Contacts):</td>
            <td>Total Hours Here</td>                
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Total:</td>
            <td>Total Hours Here</td>                
        </tr>

        </tfoot>
        <tbody>
            Do a foreach loop here for the volunteer hours
            <tr>
                <td>Contact Name</td>
                <td>Project Name</td>
                <td>Date of Project</td>
                <td>Hours spent on this day</td>
            </tr>
        </tbody>
    </table>-->
    
    
        <!-- Table with generalized hours information -->
<!--    <table class="table table-hover">
        <thead>
            <tr>
                <th>Contact</th>
                <th>Hours Contributed</th>
            </tr>
        </thead>
        <tfoot>
        <tr>
            <td>Sub Total (Primary Contacts):</td>
            <td>Total Hours Here</td>                
        </tr>
        <tr>
            <td>Sub Total (Secondary Contacts):</td>
            <td>Total Hours Here</td>                
        </tr>
        <tr>
            <td>Total:</td>
            <td>Total Hours Here</td>                
        </tr>

        </tfoot>
        <tbody>
            Do a foreach loop here for the volunteer hours
            <tr>
                <td>Contact Name</td>
                <td>Total Hours Contributed</td>
            </tr>
        </tbody>
    </table>-->
</div>
@stop            
