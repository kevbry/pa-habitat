<?php

namespace App\Repositories;

class EloquentVolunteerRepository implements VolunteerRepository {

    public function getVolunteer($id) {
        return \Volunteer::find($id);
    }

    public function getAllVolunteers() {
        return \Volunteer::join('Contact', 'Volunteer.id', '=', 'Contact.id')->orderBy('first_name', 'asc')->paginate(20);
    }
    
    public function getAllVolunteersForSeed()
    {
        return \Volunteer::lists('id');      
    }

    /**
     * Purpose: Save contact information to the database
     * @param Contact $contact A contact object to save to the database
     */
    public function saveVolunteer($volunteer) {
        $volunteer->save();
    }

    public function orderBy($sort, $order) {
        
        $order = ($order == 'a' ? 'asc' : 'desc');

        switch ($sort) {
            case 'l':
                $sortby = 'last_name';
                break;
            case 'h':
                $sortby = 'home_phone';
                break;
            case 'e':
                $sortby = 'email_address';
                break;
        }
            
        return \Volunteer::join('Contact', 'Volunteer.id', '=', 'Contact.id')->orderBy($sortby, $order)->paginate(20);
    }

}
