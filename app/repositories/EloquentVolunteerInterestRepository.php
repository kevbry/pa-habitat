<?php
/**
 *
 * @author cst210
 */
namespace App\Repositories;

class EloquentVolunteerInterestRepository implements VolunteerInterest {

    public function getVolunteerInterest($id) {
        return \VolunteerInterest::whereRaw('volunter_id =' . $id)->paginate(20);
    }

    public function saveVolunteerInterest($volunteerInterest) {
        $volunteerInterest->save();
    }
    
    public function getVolunteerInterestsNonPaginated($id) {
        return \VolunteerInterest::whereRaw('volunteer_id =' . $id)->orderBy('item_type', 'asc')->get();
    }

}
