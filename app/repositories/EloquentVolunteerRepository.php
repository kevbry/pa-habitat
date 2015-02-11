<?php

namespace App\Repositories;

class EloquentVolunteerRepository implements VolunteerRepository {

    public function getVolunteer($id) {
        return \Volunteer::find($id);
    }

    public function getAllVolunteers() {
        return \Volunteer::paginate(20);
    }

    /**
     * Purpose: Save contact information to the database
     * @param Contact $contact A contact object to save to the database
     */
    public function saveVolunteer($volunteer) {
        $volunteer->save();
    }

    
    public function getVolunteerSearchInfo($filter) {
        $searchTerm = "%" . $filter . "%";

      
        return \DB::table("Volunteer")
                        ->join('Contact', 'Contact.id', '=', 'Volunteer.id')
                        ->where('first_name', 'LIKE', $searchTerm)
                        ->orWhere('last_name', 'LIKE', $searchTerm)
                        ->selectRaw("habitat_Volunteer.id, CONCAT(first_name, ' ', last_name) AS full_name")
                        ->get();
 
    }

}
