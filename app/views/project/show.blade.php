@extends('master')

@section('title')
Project Details
@stop

@section('content')
<h1>{{ $project->name }}
     @if (Auth::check() && (Session::get('access_level') === 'project_manager' || 
    Session::get('access_level') === 'administrator' ))
    <a href="{{$project->id}}/edit"  class="btn btn-primary">Edit Details</a>
       @endif
</h1>
{{ Form::open(array('class'=>'form-horizontal')) }}
<section class="generalInfo col-md-7">
    <h3>Project Details</h3>
    <div class="form-group">
        {{ Form::label('build_number', 'Build Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('build_number',$project->build_number,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>    
    <div class="form-group">
        {{ Form::label('street_number', 'Street Address: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('street_number',$project->street_number,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('city', 'City: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('city',$project->city,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('province', 'Province: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('province',$project->province,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>    
    <div class="form-group">
        {{ Form::label('postal_code', 'Postal Code: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('postal_code',$project->postal_code,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('start_date','Start Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','start_date',$project->start_date,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('end_date','End date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','end_date',$project->end_date,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
    
    </div>
        <div class="form-group">
        {{ Form::label('blueprint_designer', 'Blueprint Designer: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('blueprint_designer',$project->blueprint_designer,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
    </div>
        <div class="form-group">
        {{ Form::label('blueprint_plan_number', 'Blueprint Plan Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('blueprint_plan_number',$project->blueprint_plan_number,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('building_permit_number', 'Building Permit Number: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::text('building_permit_number',$project->building_permit_number,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
    <div class="form-group">
        {{ Form::label('building_permit_date', 'Building Permit Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','building_permit_date',$project->building_permit_date,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
        <div class="form-group">
        {{ Form::label('mortgage_date', 'Mortgage Date: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::input('date','mortgage_date',$project->mortgage_date,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>      
    <div class="form-group">
        {{ Form::label('comments', 'Comments: ',array('class'=>'col-sm-3')) }}
        <div class="col-sm-7">
        {{ Form::textarea('comments',$project->comments,array('class'=>'form-control','readonly'=>'readonly')) }}
        </div>
    </div>
</section>

<section class="col-md-5"  id="revSpace"> 
   
        <h3 id="spacing">Additional Details</h3>
<!--  <div class="form-group">       {{ Form::label('project_coordinator', 'Project Coordinator: ') }}
        
        @if (!empty($projectContact))
            {{ Form::text('project_coordinator',$projectContact,array('class'=>'form-control','readonly'=>'readonly')) }}
        @else
            {{ Form::text('project_coordinator','Not Specified',array('class'=>'form-control','readonly'=>'readonly')) }}
        @endif</div>-->
    
    <div class="form-group" id="spacingSecond">
        {{ Form::label('family', 'Family: ') }}
       {{ Form::text('fam',( $project->family  ? $project->family->name : "Not Assigned") ,array('class'=>'form-control','readonly'=>'readonly')) }}
    </div>
</section>

<section class="col-md-5"> 
    <div class="form-group row">
        {{ Form::label('contacts', 'Project Contacts:') }}
        
        <table class="table table-hover scrollable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                  @if (!empty($project))
                    @foreach($projectContacts as $projectContact)

                   <tr>
                       <td>{{$projectContact->contact->first_name . " " . 
                                   $projectContact->contact->last_name}}</td>
                       <td>{{$projectContact->role->role}}</td>
                   </tr>
                   @endforeach
                @endif
            </tbody>
        </table>
         {{ HTML::linkRoute('projContactsView', 'View Contact Details', array($project->id), array('class' => 'btn btn-primary')) }}
         @if (Auth::check() && (Session::get('access_level') === 'project_manager' || 
        Session::get('access_level') === 'administrator' ))
         {{ HTML::linkRoute('projContactsAdd', 'Add Contact', array($project->id), array('class' => 'btn btn-primary')) }}
         @endif
    </div> 
</section>

<section class="col-md-5"> 
    <div class="form-group row">
        {{ Form::label('items', 'Project Items:') }}
        
        <!-- Items Table to go here -->
        <table class="table table-hover scrollable">
            <thead>
                <tr>
                    <th>Item Type</th>
                    <th>Manufacturer</th>
                </tr>
            </thead>
            <tbody>
                  @if (!empty($project))
                    @foreach($projectItems as $projectItem)

                   <tr>
                       <td>{{$projectItem->item_type}}</td>
                       <td>{{$projectItem->manufacturer}}</td>
                   </tr>
                   @endforeach
                @endif
            </tbody>
        </table>
         {{ HTML::linkRoute('viewItems', 'View Item Details', array($project->id), array('class' => 'btn btn-primary')) }}
             @if (Auth::check() && (Session::get('access_level') === 'project_manager' || 
          Session::get('access_level') === 'administrator' ))
         {{ HTML::linkRoute('projItemsAdd', 'Add Items', array($project->id), array('class' => 'btn btn-primary')) }}
         {{ HTML::linkRoute('editFormForItems', 'Edit Items', array($project->id), array('class' => 'btn btn-primary')) }}
         @endif
    </div> 
</section>
 
 <section class="col-md-5">   
        <div class="form-group row">
        {{ Form::label('inspections', 'Project Inspections:') }}
        
        <table class="table table-hover scrollable">
            <thead>
                <tr>
                    <th>Inspection Type</th>
                    <th>Pass/Fail</th>
                </tr>
            </thead>
            <tbody>
                  @if (!empty($project))
                    @foreach($projectInspections as $projectInspection)

                   <tr>
                       <td>{{$projectInspection->type}}</td>
                       <td>
                        @if($projectInspection->pass == 0)
                            FAIL
                        @else
                            PASS
                        @endif
                       </td>
                   </tr>

                   @endforeach
                @endif
            </tbody>
        </table>
         {{ HTML::linkRoute('projInspectionsView', 'View Inspection Details', array($project->id), array('class' => 'btn btn-primary')) }}
             @if (Auth::check() && (Session::get('access_level') === 'project_manager' || 
            Session::get('access_level') === 'administrator' ))
         {{ HTML::linkRoute('projInspectionsAdd', 'Add Inspections', array($project->id), array('class' => 'btn btn-primary')) }}
         {{ HTML::linkRoute('editFormForInspections', 'Edit Inspections', array($project->id), array('class' => 'btn btn-primary')) }}
         @endif
    </div>
         <div class="form-group row">
        {{ Form::label('hours', 'Project Hours:') }}
        
        <!-- Hours Table to go here -->
        <table class="table table-hover scrollable">
            <thead>
                <tr>
                    <th>Volunteer Name</th>
                    <th>Date</th>
                    <th>Hours</th>
                </tr>
            </thead>
            <tfoot>
            <td></td>
            <td>Total:</td>
            
            <td>   
                @if (isset($volunteerhours))
               <?php $totalHours=0;?>
                    @foreach($volunteerhours as $hour)

               <?php $totalHours=$totalHours+$hour->hours;?>

                   @endforeach
                   {{$totalHours}}
                @endif </td>
            </tfoot>
            <tbody>
                  @if (isset($volunteers))
                    @foreach($volunteerhours as $hour)

                   <tr>
                       @foreach($volunteers as $volunteer)
                       @if($volunteer->id === $hour->volunteer_id)
                            <td>{{$volunteer->contact->first_name . ' ' . $volunteer->contact->last_name}}</td>
                       @endif
                       @endforeach
                       <td>{{$hour->date_of_contribution}}</td>
                       <td>{{$hour->hours}}</td>
                   </tr>

                   @endforeach
                @endif
            </tbody>
        </table>
        {{ HTML::linkRoute('projHoursRoute', 'View Hours', array($project->id), array('class' => 'btn btn-primary')) }}
            @if (Auth::check() && (Session::get('access_level') === 'project_manager' || 
        Session::get('access_level') === 'administrator' ))
        {{ HTML::linkRoute('projHoursAdd', 'Add Hours', array($project->id), array('class' => 'btn btn-primary')) }}
        {{ HTML::linkAction('projHoursEdit','Edit Hours', array($project->id), array('class'=>'btn btn-primary'))}}
        
        <br /><br />
        {{ HTML::linkRoute('projectReport', 'Generate Hours Report', array($project->id), array('class' => 'btn btn-primary')) }}
        @endif
    </div>
    
</section>
@stop            
