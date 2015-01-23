<?php

namespace App\Repositories;

class EloquentVolunteerHoursRepository implements VolunteerHoursRepository {
    
    public function getHoursForProject($id)
    {
        return \VolunteerHours::whereRaw('project_id ='.$id)->orderBy('date_of_contribution','asc')->get(); 
    }
    
    public function getAllHours()
    {
        return \VolunteerHours::all();  
    }
    
    public function saveVolunteerHours($volunteerHours)
    {

        
        $volunteerHours->save();
    }
    
     public function getHoursForVolunteer($volunteerId){
         
         return \VolunteerHours::whereRaw('volunteer_id ='.$volunteerId)->orderBy('date_of_contribution','asc')->get(); 
     }
}
