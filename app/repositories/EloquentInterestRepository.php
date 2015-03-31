<?php

namespace App\Repositories;

/**
 * Description of EloquentProjectRolesRepository
 *
 * @author cst220
 */
class EloquentInterestRepository implements InterestRepository {

    public function getInterest($id)
    {
        return \Interest::find($id);
    }
    
    public function getAllInterests()
    {
        return \Interest::orderBy('description','asc')->get();
    }
}