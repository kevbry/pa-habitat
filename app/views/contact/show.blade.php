@extends('master')

@section('title')
Contact Details
@stop

@section('content')

{{ Form::open(array('class'=>'form-horizontal')) }}
<h1>{{ $contact->first_name . " " . $contact->last_name . "'s Details" }}
    <a href="{{$contact->id}}/edit" class="btn btn-primary">Edit Details</a></h1>
<section class="generalInfo col-md-7">
<h3>Contact Details</h3>
 <div class="form-group">
     {{ Form::label('email_address','Email: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('email_address',$contact->email_address,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('home_phone','Home Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('home_phone',$contact->home_phone,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('cell_phone','Cell Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('cell_phone',$contact->cell_phone,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('work_phone','Work Phone: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('work_phone',$contact->work_phone,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('street_address','Street Address: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('street_address',$contact->street_address,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('city','City: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('city',$contact->city,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('province','Province: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('province',$contact->province,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('postal_code','Postal Code: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('postal_code',$contact->postal_code,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('country','Country: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::text('country',$contact->country,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
 <div class="form-group">
     {{ Form::label('comments','Comments: ',array('class'=>'col-sm-3')) }}
     <div class="col-sm-7">
     {{ Form::textarea('comments',$contact->comments,array('class'=>'form-control','readonly'=>'readonly')) }}
     </div>
 </div>
</section>
{{ Form::close() }}
{{ Form::open(array('class'=>'form-horizontal')) }}
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

 
 <section class='volunteerFields col-md-5 row'>
     <h3>Volunteer Details</h3>
     <div class="form-group">
        {{ Form::label('is_volunteer', 'Is a Volunteer:') }}
        {{ Form::text('is_volunteer', $volunteer ? 'Yes' : 'No',array('class'=>'form-control','readonly'=>'readonly')) }}
    </div>
    @if($volunteer)
    
     <div class="form-group">
        {{ Form::label('volunteer_status', 'Volunteer Status:') }}
        {{ Form::text('volunteer_status', $volunteerStatus,array('class'=>'form-control','readonly'=>'readonly')) }}
    </div>

    <div class="form-group">
        {{ Form::label('safety_date', 'Last Attended Safety Meeting Date:') }}
        {{ Form::text('safety_date', $volunteerSafetyDate,array('class'=>'form-control','readonly'=>'readonly')) }}
    </div>    
     
    <div class="form-group row">
        {{ Form::label('hours', 'Volunteered Hours:') }}
        
        <!-- Hours Table to go here -->
        <table class="table table-hover scrollable">
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
            
            <td>   
                @if (isset($volunteer))
               <?php $totalHours=0;?>
                    @foreach($volunteer->volunteerHours as $hour)

               <?php $totalHours=$totalHours+$hour->hours;?>

                   @endforeach
                   {{$totalHours}}
                @endif </td>
            </tfoot>
            <tbody>
                  @if (isset($volunteer))
                    @foreach($volunteer->volunteerHours as $hour)

                   <tr>
                       <td>{{$hour->project->name}}</td>
                       <td>{{$hour->date_of_contribution}}</td>
                       <td>{{$hour->hours}}</td>
                   </tr>

                   @endforeach
                @endif
            </tbody>
        </table>
         {{ HTML::linkRoute('volHoursRoute', 'View Hours Details', array($contact->id), array('class' => 'btn btn-primary')) }}
         {{ HTML::linkRoute('volHoursAdd', 'Add Hours', array($contact->id), array('class' => 'btn btn-primary')) }}
         {{ HTML::linkRoute('volHoursEditRoute', 'Edit Hours', array($contact->id), array('class'=>'btn btn-primary')) }}
         <br /> <br />
         {{ HTML::linkRoute('volunteerReport', 'Generate Hours Report', array($contact->id), array('class'=>'btn btn-primary')) }}
    </div>
     
    <div class="form-group">
        {{ Form::label('availability', 'Availability:') }}
        <table class="table table-hover">
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
                @else
                    <tr>
                        <td colspan="3">No availability</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ Form::button( 'Edit Availability', array('id' => 'editAvail','class'=>'btn btn-primary') ) }}
    </div>
     
    <div class="form-group">
        {{ Form::label('certification', 'Certification(s):') }}      
        <table class="table table-hover">
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
                @else
                    <tr>
                        <td colspan="4">No certifications</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ Form::button('Edit Certifications', array('id' => 'editCerts','class'=>'btn btn-primary')) }}
    </div>
     
    <div class="form-group">
        {{ Form::label('trades', 'Trade(s):') }}
        <table class="table table-hover">
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
                @else
                    <tr>
                        <td colspan="2">No trades</td>
                    </tr>                
                @endif
            </tbody>
        </table>
        {{ Form::button('Edit Trades', array('id' => 'editTrades','class'=>'btn btn-primary')) }}       
    </div>
     
    <div class="form-group">
        {{ Form::label('skills', 'Skill(s) and Experience(s):') }}      
        <table class="table table-hover">
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
                @else
                    <tr>
                        <td colspan="3">No skills</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ Form::button('Edit Skills', array('id' => 'editSkills','class'=>'btn btn-primary')) }}  
    </div>
    
    <div class="form-group">
        {{ Form::label('interests', 'Interest(s):') }}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Interest</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($volunteer))
                    @if(!empty($volunteer->interests))
                        @foreach ($volunteer->interests as $interest)
                            <tr>
                                <td>{{$interest->description}}</td>
                                <td>{{$interest->pivot->comments}}</td>
                            </tr>
                        @endforeach
                    @endif
                @else
                    <tr>
                        <td colspan="3">No interests</td>
                    </tr>
                @endif
            </tbody>
        </table>
        {{ HTML::linkRoute('createInterests', 'Add Interests', array($contact->id), array('class' => 'btn btn-primary')) }}
        {{ HTML::linkRoute('editInterests', 'Edit Interests', array($contact->id), array('class' => 'btn btn-primary')) }}
    </div> 
          @endif
 </section>
 {{ Form::close() }}

 @stop            
