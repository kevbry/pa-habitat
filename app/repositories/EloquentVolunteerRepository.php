<?php
namespace App\Repositories;

class EloquentVolunteerRepository implements VolunteerRepository
{
    public function getVolunteer($id)
    {
        return \Volunteer::find($id);
    }
        
    public function getAllVolunteers()
    {
        return \Volunteer::paginate(20);        
    }
    
    /**
     * Purpose: Save contact information to the database
     * @param Contact $contact A contact object to save to the database
     */
    public function saveVolunteer($volunteer)
    {
        $volunteer->save();
    }
    
    public function orderBy($sortby, $order)
    {
           return \Contact::orderBy($sortby,$order)->get();
        
        
    }
}
