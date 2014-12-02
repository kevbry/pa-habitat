@extends('master')

@section('title')
Contact Details
@stop

@section('content')
<h1>Contact details</h1>
<h3>{{ $contact->first_name . " " . $contact->last_name }}</h3>

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
 
 <?php
    $volunteerStatus = 0;
    $volunteerSafetyDate = "";
    
    if( $volunteer )
    {
        $volunteerStatus = $volunteer->active_status;
        $volunteerSafetyDate = $volunteer->last_attended_safety_meeting_date;
    }
 ?>
     <div>
        {{ Form::label('is_volunteer', 'Is a Volunteer: ') }}
        {{ Form::text('is_volunteer', $volunteer ? 'Yes' : 'No') }}
    </div>
 
 <div class='volunteerFields'>

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
        
    </div>
     
    <div>
        {{ Form::label('availability', 'Availability: ') }}
        {{ Form::button( 'Edit Availiability' ) }}
        
        <!-- Availability Table to go here -->
        
    </div>
     
    <div>
        {{ Form::label('certification', 'Certification(s): ') }}
        {{ Form::button('Edit Certifications') }}
        
        <!-- Certification Table to go here -->
        
    </div>
     
    <div>
        {{ Form::label('trades', 'Trade(s): ') }}
        {{ Form::button('Edit Trades') }}
        
        <!-- Trades Table to go here -->
        
    </div>
     
    <div>
        {{ Form::label('skills', 'Skill(s) and Experience(s): ') }}
        {{ Form::button('Edit Skills') }}
                
        <!-- Skills Table to go here -->
        
    </div>
     
    <div>
        {{ Form::label('interests', 'Interest(s): ') }}
        {{ Form::button('Edit Interests') }}
        
        <!-- Skills Table to go here -->
    </div>
          
 </div>
 {{ Form::close() }}

 @stop            
