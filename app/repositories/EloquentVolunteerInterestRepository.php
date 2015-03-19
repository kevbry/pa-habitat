<?php
/**
 *
 * @author cst210
 */
namespace App\Repositories;

class EloquentVolunteerInterestRepository implements VolunteerInterestRepository {

    public function getVolunteerInterests($id) {
        return \VolunteerInterest::whereRaw('volunteer_id =' . $id)->paginate(20);
    }

    public function saveVolunteerInterest($volunteerInterest) {
        $volunteerInterest->save();
    }
    
    public function getVolunteerInterestsNonPaginated($id) {
        return \VolunteerInterest::where('volunteer_id','=', $id)->get();
    }

}
