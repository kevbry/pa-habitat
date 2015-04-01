@extends('master')

@section('title')
Family Details
@stop

<?php
// Retrieve the base URL for linking to other parts of the project


$requiredHours = 500; // Temporary global defining required hours in a project
$aggregateHours = array(); // Collection of hours by volunteer id
$activeContacts = array(); // Contacts active within the family
$inactiveContacts = array(); // Contacts not currently active within the family
$primaryHours = 0; // Total hours contributed by primary contacts
$secondaryHours = 0; // Total hours contributed by secondary contacts


// Used to gather ids of contributing volunteers, and sum up their contributed
// hours to this family
foreach($family[2] as $hoursData)
{
    if(array_key_exists($hoursData['volunteer_id'], $aggregateHours))
    {
        $aggregateHours[$hoursData['volunteer_id']] += $hoursData['hours'];
    }
    else
    {
        $aggregateHours[$hoursData['volunteer_id']] = $hoursData['hours'];
    }
}

// Used to gather active status of a contact, and sum the primary and secondary
// hours for this family
foreach($family[1] as $familyContact)
{
    if (!array_key_exists($familyContact->id, $aggregateHours))
    {
        $aggregateHours[$familyContact->id] = 0;
    }
    if($familyContact->currently_active == true)
    {
        array_push($activeContacts, $familyContact);
    }
    else
    {
        array_push($inactiveContacts, $familyContact);
    }
    if ($familyContact->primary == true)
    {
        $primaryHours += $aggregateHours[$familyContact->id];
    }
    else
    {
        $secondaryHours += $aggregateHours[$familyContact->id];
    }
}
// Total sum of all hours contributed
$totalHours = array_sum($aggregateHours);
$percentHours = number_format(($totalHours / $requiredHours) * 100, 2);
?>

@section('content')
<h1>Family details</h1>
<h2>{{$family[0]->name}}</h2>
<h3>Status: {{$family[0]->status}} ({{$totalHours}}/{{$requiredHours}} Hours Contributed ({{$percentHours}}%))</h3>
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
        <tbody>    
        @foreach($activeContacts as $contact)
            <?php 
                $contactType = $contact->primary ? "Primary" : "Secondary"; ?>
            <tr>
                <td>{{$contact->first_name . ' ' . $contact->last_name}}</td>
                <td>{{$contactType}}</td> 
                <!-- Note: Below, we are using string concatenation to force a 0 to appear on the page.
                 Without this trick, the system deposits the label into the value of the field, preventing
                 us from reporting 0 values. REALLY ANNOYING. -->
                <td>{{Form::label('contact_total_hours', " " . $aggregateHours[$contact->id], array('class'=>'col-sm-7'))}}</td>
                <td>
                {{ HTML::linkRoute('contact.show', 'View Details', $contact->id) }}
                </td>
            </tr>
        @endforeach    
        </tbody>
    </table>

</section>
</section>
<h4>Inactive Contacts</h4>
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
        <tbody>    
        @foreach($inactiveContacts as $contact)
            <?php $contactType = $contact->primary ? "Primary" : "Secondary"; ?>
            <tr>
                <td>{{$contact->first_name . ' ' . $contact->last_name}}</td>
                <td>{{$contactType}}</td>
                <td>{{Form::label('contact_total_hours', " " . $aggregateHours[$contact->id], array('class'=>'col-sm-7'))}}</td>
                <td>{{ HTML::linkRoute('contact.show', 'View Details', $contact->id) }}</td>
            </tr>
        @endforeach    
        </tbody>
    </table>
    <div>
        <div><p>Total Primary Hours: <span>{{$primaryHours}}</span></p></div>
        <div><p>Total Secondary Hours: <span>{{$secondaryHours}}</span></p></div>
        <div><p>Total Family Hours: <span>{{$totalHours}}</span></p></div>
    </div>

</section>
</section>
@stop            
