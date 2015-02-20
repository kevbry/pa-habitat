@extends('master')

@section('title')
Project Hours for {{$project->name}}
@stop

@section('content')

<section class="col-md-12">
<h3 class="name">Project Hours for <strong>{{$project->name}}</strong></h3>
<h3 class="hours">Total Hours <strong>{{$totalHours}}</strong></h3>
</section>
            <?php
            if(!empty($volunteerhours) && count($volunteerhours) != 0)
            {
                $currentVolunteer = $volunteerhours[0]->volunteer_id;
            }
            $currentVolunteerHours = 0;
            
            ?>
    <section class="col-md-7 project">
        @if(!empty($volunteerhours) && count($volunteerhours) != 0)
        <h4 class="name">Volunteer Name: 
            <strong>{{$volunteerhours[0]->volunteer->contact->first_name 
                        . ' ' . $volunteerhours[0]->volunteer->contact->last_name}}</strong></h4>
        @endif
    <table class="table">
        
        <thead>
            <tr><th>Date</th><th>Hours</th><th>Hour type</th><th>Family</th></tr>
        </thead>

            <tbody>
            @if (!empty($volunteerhours) && count($volunteerhours) != 0) 
                @foreach($volunteerhours as $volunteerhour)
                @if ($volunteerhour->volunteer_id == $currentVolunteer)
                <tr>
                    <td>{{$volunteerhour->date_of_contribution}}</td>
                    <td>{{$volunteerhour->hours}}</td>
                    <td>
                    @if($volunteerhour->paid_hours == 0)
                        Volunteer
                    @else
                        Paid
                    @endif
                    </td>
                    <td>
                    @if(isset($volunteerhour->family->name))
                    {{$volunteerhour->family->name}}
                    @else
                    --
                    @endif</td>
                    <td></td>
                </tr>
                <?php
                    $currentVolunteerHours += $volunteerhour->hours;
                ?>
                @else
                <h4 class="hours">Total Volunteer Hours <strong>{{$currentVolunteerHours}}</strong></h4>
            </tbody>
    </table>
    </section>
    <?php
    if (!empty($volunteerhours) && count($volunteerhours) != 0) {
    $currentVolunteer = $volunteerhour->volunteer_id;
    }
    $currentVolunteerHours = 0;
    ?>
    
    <section class="col-md-7 project">
        <h4 class="name">Volunteer Name: 
            <strong>{{$volunteerhour->volunteer->contact->first_name 
                        . ' ' . $volunteerhour->volunteer->contact->last_name}}</strong></h4>
    <table class="table">
        <thead>
            <tr><th>Date</th><th>Hours</th><th>Hour type</th><th>Family</th></tr>
        </thead>
            <tbody>
                <tr>
                    <td>{{$volunteerhour->date_of_contribution}}</td>
                    <td>{{$volunteerhour->hours}}</td>
                    <td>
                    @if($volunteerhour->paid_hours == 0)
                        Volunteer
                    @else
                        Paid
                    @endif
                    </td>
                    <td>
                    @if(isset($volunteerhour->family->name))
                    {{$volunteerhour->family->name}}
                    @else
                    --
                    @endif</td>
                    <td></td>
                </tr>
                <?php
                    $currentVolunteerHours += $volunteerhour->hours;
                ?>
                @endif
                
                @endforeach
            @endif
            <h4 class="hours">Total Volunteer Hours <strong>{{$currentVolunteerHours}}</strong></h4>
        </tbody>
    </table>
    </section>
<section class="col-md-7">
 {{ HTML::linkAction('ProjectController@show','Back To Project', array($project->id)) }}
</section>
@stop
