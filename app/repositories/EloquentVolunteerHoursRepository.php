<?php

namespace App\Repositories;

class EloquentVolunteerHoursRepository implements VolunteerHoursRepository {

    public function getHoursForProject($id) {
        return \VolunteerHours::whereRaw('project_id =' . $id)->orderBy('date_of_contribution', 'asc')->paginate(15);
    }

    public function getHoursForFamily($family_id) {
        // Retrieve a sum of hours for a family, grouped by contact
        return \VolunteerHours::query()
                        ->select('volunteer_id', 'hours')
                        ->whereIn('volunteer_id', function($query) {
                            $query->select('contact_id')
                            ->from('FamilyContact')
                            ->join('Family', 'FamilyContact.family_id', '=', 'Family.id');
                        })
                        ->where('family_id', '=', $family_id)
                        ->get();
    }

    public function getAllHours() {
        return \VolunteerHours::all();
    }

    public function saveVolunteerHours($volunteerHours) {
        $volunteerHours->save();
    }

    public function getHoursForVolunteer($volunteerId) {

        return \VolunteerHours::whereRaw('volunteer_id =' . $volunteerId)->orderBy('date_of_contribution', 'asc')->paginate(15);
    }
    
    public function getHoursForVolunteerNonPaginated($volunteerId) {

        return \VolunteerHours::whereRaw('volunteer_id =' . $volunteerId)->orderBy('date_of_contribution', 'asc')->paginate(15);
    }

    public function orderBy($sortby, $order) {


        $order = ($order == 'a' ? 'asc' : 'desc');

        switch ($sortby) {
            case 'l':
                $sortby = 'last_name';
                break;
            case 'h':
                $sortby = 'hours';
                break;
            case 'd':
                $sortby = 'date_of_contribution';
                break;
            case 't':
                $sortby = 'paid_hours';
                break;
            case 'p':
                $sortby = 'project_id';
                break;
            case 'f':
                $sortby = 'family_id';
                break;
        }

        return \Volunteer::join('Contact', 'Volunteer.id', '=', 'Contact.id')->join('Contact', 'Volunteer.id', '=', 'Contact.id')->orderBy($sortby, $order)->paginate(20);
    }

}
