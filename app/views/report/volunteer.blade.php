@extends('master')

@section('title')
Volunteer Hours for Volunteer {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}
@stop

@section('content')
<section class="col-md-12">
<h3 class="name">Volunteer Hours for <strong>{{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}</strong></h3>
<h3 class="hours">Total Hours <strong>{{$totalHours}}</strong></h3>
</section>
            <?php
            if(!empty($volunteerhours))
            {
                $currentProject = $volunteerhours[0]->project_id;
            }
            $currentProjectHours = 0;
            
            ?>
    <section class="col-md-7 project">
        @if(!empty($volunteerhours))
        <h4 class="name">Project Name: <strong>{{$volunteerhours[0]->project->project_name}}</strong></h4>
        @endif
    <table class="table">
        
        <thead>
            <tr><th>Date</th><th>Hours</th><th>Hour type</th><th>Family</th></tr>
        </thead>

            <tbody>
            @if (!empty($volunteerhours)) 
                @foreach($volunteerhours as $volunteerhour)
                @if ($volunteerhour->project_id == $currentProject)
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
                    $currentProjectHours += $volunteerhour->hours;
                ?>
                @else
                <h4 class="hours">Total Project Hours <strong>{{$currentProjectHours}}</strong></h4>
            </tbody>
    </table>
    </section>
    <?php
    $currentProject = $volunteerhour->project_id;
    $currentProjectHours = 0;
    ?>
    
    <section class="col-md-7 project">
        <h4 class="name">Project Name: <strong>{{$volunteerhour->project->project_name}}</strong></h4>
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
                    $currentProjectHours += $volunteerhour->hours;
                ?>
                @endif
                
                @endforeach
            @endif
            <h4 class="hours">Total Project Hours <strong>{{$currentProjectHours}}</strong></h4>
        </tbody>
    </table>
    </section>
<section class="col-md-7">
 {{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id)) }}
</section>

@stop
