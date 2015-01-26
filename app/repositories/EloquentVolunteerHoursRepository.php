<?php

namespace App\Repositories;

class EloquentVolunteerHoursRepository implements VolunteerHoursRepository {
    
    public function getHoursForProject($id)
    {
        return \VolunteerHours::whereRaw('project_id ='.$id)->orderBy('date_of_contribution','asc')->get(); 
    }
    
    
    public function getHoursForFamily($family_id) 
    {
        // Retrieve a sum of hours for a family, grouped by contact
        return \VolunteerHours::query()
                ->select()
                ->where()
                ->get();
    }
    
    public function getAllHours()
    {
        return \VolunteerHours::all();  
    }
    
    public function saveVolunteerHours($volunteerHours)
    {
        $volunteerHours->save();
    }
}
