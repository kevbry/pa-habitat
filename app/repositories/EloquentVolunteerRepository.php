<?php
namespace App\Repositories;

class EloquentVolunteerRepository implements VolunteerRepository {

    public function getVolunteer($id) {
        return \Volunteer::find($id);
    }

    public function getAllVolunteers() {
        return \Volunteer::join('Contact', 'Volunteer.id', '=', 'Contact.id')->orderBy('first_name', 'asc')->paginate(20);
    }
    
    public function getAllVolunteersForSeed() {
        return \Volunteer::lists('id'); 
    }

    public function getAllVolunteersNonPaginated() {
        return \Volunteer::join('Contact', 'Volunteer.id', '=', 'Contact.id')->orderBy('first_name', 'asc')->get();
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
                ->selectRaw("habitat_Volunteer.id, CONCAT(first_name, ' ', last_name) AS name, 'contact' AS type")
                ->join('Contact', 'Contact.id', '=', 'Volunteer.id')
                ->where('first_name', 'LIKE', $searchTerm)
                ->orWhere('last_name', 'LIKE', $searchTerm)
                ->get();
 
    }

    public function orderBy($sort, $order) {
        
        $order = ($order == 'a' ? 'asc' : 'desc');

        switch ($sort) {
            case 'l':
                $sortby = 'first_name';
                break;
            case 'e':
                $sortby = 'email_address';
                break;
        }
            
        return \Volunteer::join('Contact', 'Volunteer.id', '=', 'Contact.id')->orderBy($sortby, $order)->paginate(20);
    }

}
