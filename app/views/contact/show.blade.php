@extends('master')

@section('title')
Contact Details
@stop

@section('content')
<h1>Contact details</h1>
<h3>{{ $contact->first_name . " " . $contact->last_name }}</h3>
<section class="generalInfo">
 {{ Form::open() }}
 <div>
     {{ Form::label('email_address','Email: ') }}
     {{ Form::text('email_address',$contact->email_address) }}
 </div>
 <div>
     {{ Form::label('home_phone','Home Phone: ') }}
     {{ Form::text('home_phone',$contact->home_phone) }}
 </div>
 <div>
     {{ Form::label('cell_phone','Cell Phone: ') }}
     {{ Form::text('cell_phone',$contact->cell_phone) }}
 </div>
 <div>
     {{ Form::label('work_phone','Work Phone: ') }}
     {{ Form::text('work_phone',$contact->work_phone) }}
 </div>
 <div>
     {{ Form::label('street_address','Street Address: ') }}
     {{ Form::text('street_address',$contact->street_address) }}
 </div>
 <div>
     {{ Form::label('city','City: ') }}
     {{ Form::text('city',$contact->city) }}
 </div>
 <div>
     {{ Form::label('province','Province: ') }}
     {{ Form::text('province',$contact->province) }}
 </div>
 <div>
     {{ Form::label('postal_code','Postal Code: ') }}
     {{ Form::text('postal_code',$contact->postal_code) }}
 </div>
 <div>
     {{ Form::label('country','Country: ') }}
     {{ Form::text('country',$contact->country) }}
 </div>
 <div>
     {{ Form::label('comments','Comments: ') }}
     {{ Form::text('comments',$contact->comments) }}
 </div>
</section>
 <?php
    $volunteerStatus = 0;
    $volunteerSafetyDate = "";
    
    if( $volunteer )
    {
        $volunteerStatus = $volunteer->active_status;
        $volunteerSafetyDate = $volunteer->last_attended_safety_meeting_date;
    }
    if ($volunteerStatus === 1) {
        $volunteerStatus = 'Active';
    }
    elseif ($volunteerStatus === 0){
        $volunteerStatus = 'Inactive';
    }
 ?>

 
 <section class='volunteerFields'>
     <div>
        {{ Form::label('is_volunteer', 'Is a Volunteer: ') }}
        {{ Form::text('is_volunteer', $volunteer ? 'Yes' : 'No') }}
    </div>
    <div>
        {{ Form::label('volunteer_status', 'Volunteer Status: ') }}
        {{ Form::text('volunteer_status', $volunteerStatus) }}
    </div>

    <div>
        {{ Form::label('safety_date', 'Last Attended Safety Meeting Date: ') }}
        {{ Form::text('safety_date', $volunteerSafetyDate) }}
    </div>
     
     
    <div>
        {{ Form::label('hours', 'Volunteered Hours: ') }}
        
        <!-- Hours Table to go here -->
        <table>
            <thead>
                <tr>
                    <th>Project</th>
                    <th>Date</th>
                    <th>Hours</th>
                </tr>
            </thead>
            <tfoot>
            <td></td>
            <td>Total:</td>
            <td>Total Hours Here</td>
            </tfoot>
            <tbody>
                <!--Do a foreach loop here for the volunteer hours-->
                <tr>
                    <td>Project Name</td>
                    <td>Date of Project</td>
                    <td>Hours spent on this day</td>
                </tr>
            </tbody>
        </table>
    </div>
     
    <div>
        {{ Form::label('availability', 'Availability: ') }}
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Hours Available</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($volunteer))
                @foreach ($volunteer->availability as $availHours)
                    <tr>
                        <td>{{$availHours->date}}</td>
                        <td>{{$availHours->time}}</td>
                        <td>{{$availHours->hours_available}}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{ Form::button( 'Edit Availability', array('id' => 'editAvail') ) }}
    </div>
     
    <div>
        {{ Form::label('certification', 'Certification(s): ') }}      
        <table>
            <thead>
                <tr>
                    <th>Certification</th>
                    <th>Earned Date</th>
                    <th>Expiry Date</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($volunteer))
                @foreach ($volunteer->certifications as $certification)
                    <tr>
                        <td>{{$certification->cert_name}}</td>
                        <td>{{$certification->pivot->cert_earned_date}}</td>
                        <td>{{$certification->pivot->cert_expiry_date}}</td>
                        <td>{{$certification->pivot->comment}}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{ Form::button('Edit Certifications', array('id' => 'editCerts')) }}
    </div>
     
    <div>
        {{ Form::label('trades', 'Trade(s): ') }}
        <table>
            <thead>
                <tr>
                    <th>Trade</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($volunteer))
                @foreach ($volunteer->trades as $trade)
                    <tr>
                        <td>{{$trade->trade_name}}</td>
                        <td>{{$trade->pivot->comments}}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{ Form::button('Edit Trades', array('id' => 'editTrades')) }}       
    </div>
     
    <div>
        {{ Form::label('skills', 'Skill(s) and Experience(s): ') }}      
        <table>
            <thead>
                <tr>
                    <th>Skill</th>
                    <th>Years of Experience</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($volunteer))
                @foreach ($volunteer->skills as $skill)
                    <tr>
                        <td>{{$skill->description}}</td>
                        <td>{{$skill->pivot->yearsExperience}}</td>
                        <td>{{$skill->pivot->comments}}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{ Form::button('Edit Skills', array('id' => 'editSkills')) }}  
    </div>
     
    <div>
        {{ Form::label('interests', 'Interest(s): ') }}
        <table>
            <thead>
                <tr>
                    <th>Interest</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($volunteer))
                @foreach ($volunteer->interests as $interest)
                    <tr>
                        <td>{{$interest->description}}</td>
                        <td>{{$interest->pivot->comments}}</td>
                    </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        {{ Form::button('Edit Interests', array('id' => 'editInterests')) }}
    </div>
          
 </section>
 {{ Form::close() }}

 @stop            
