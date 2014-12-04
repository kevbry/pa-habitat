<?php
namespace App\Repositories;

class EloquentVolunteerRepository implements VolunteerRepository
{
    public function getVolunteer($id)
    {
        return \Volunteer::with('availability')->with('certifications')->find($id);
    }
        
    public function getAllVolunteers()
    {
        return \Volunteer::all();        
    }
    
    /**
     * Purpose: Save contact information to the database
     * @param Contact $contact A contact object to save to the database
     */
    public function saveVolunteer($volunteer)
    {
        $volunteer->save();
    }
}
