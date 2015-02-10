@extends('master')

@section('title')
Volunteer Hours for Volunteer {{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}
@stop

@section('content')

<p>Volunteer Hours for <strong>{{$volunteer->contact->first_name. ' ' .$volunteer->contact->last_name}}</strong></p>
<p>Total Hours <strong>{{$totalHours}}</strong></p>

            <?php
            $currentProject = $volunteerhours[0]->project_id;
            $currentProjectHours = 0;
            
            ?>
    <section class="col-md-7">
    <h4>Project Name: {{$volunteerhours[0]->project->project_name}}</h4>
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
                <p>Project Hours <strong>{{$currentProjectHours}}</strong></p>
            </tbody>
    </table>
    </section>
    <?php
    $currentProject = $volunteerhour->project_id;
    $currentProjectHours = 0;
    ?>

    <section class="col-md-7">
    <h4>Project Name: {{$volunteerhour->project->project_name}}</h4>
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
            <p>Project Hours <strong>{{$currentProjectHours}}</strong></p>
        </tbody>
    </table>
    </section>
<section class="col-md-7">
 {{ HTML::linkAction('ContactController@show','Back To Volunteer', array($volunteer->id)) }}
</section>

@stop
