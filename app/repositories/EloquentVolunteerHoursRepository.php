<?php

namespace App\Repositories;

class EloquentVolunteerHoursRepository implements VolunteerHoursRepository {
    
    public function getHoursForProject($id)
    {
        return \VolunteerHours::whereRaw('project_id ='.$id)->orderBy('date_of_contribution','asc')->paginate(15); 
    }
    
    
    public function getHoursForFamily($family_id) 
    {
        // Retrieve a sum of hours for a family, grouped by contact
        return \VolunteerHours::query()
                ->select('volunteer_id', 'hours')
                ->whereIn('volunteer_id', function($query)
                {
                    $query->select('contact_id')
                            ->from('FamilyContact')
                            ->join('Family', 'FamilyContact.family_id', '=', 
                                    'Family.id');
                })
                ->where('family_id', '=', $family_id)
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
    
     public function getHoursForVolunteer($volunteerId){
         
         return \VolunteerHours::whereRaw('volunteer_id ='.$volunteerId)->orderBy('date_of_contribution','asc')->paginate(15); 
     }
}
