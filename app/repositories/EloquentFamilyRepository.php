<?php

namespace App\Repositories;

/**
 * Description of EloquentFamilyRepository
 *
 * @author cst220
 */
class EloquentFamilyRepository implements FamilyRepository {

    public function getFamily($id) {
        return \Family::find($id);
    }

    public function getAllFamilies() {
        return \Family::paginate(20);
    }
    
    public function getAllFamiliesForSeed()
    {
        return \Family::lists('id');      
    }

    public function saveFamily($family) {
        $family->save();
    }
    

    public function orderBy($sort, $order) 
	{

        $order = ($order == 'a' ? 'asc' : 'desc');

        switch ($sort) {
            case 'f':
                $sortby = 'name';
                break;
            case 's':
                $sortby = 'status';
                break;
        }

        return \Family::orderBy($sortby, $order)->paginate(20);
    }

    public function getFamilySearchInfo($filter)
    {
        $searchTerm = "%" . $filter . "%";
        
        return \Family::query()
                ->selectRaw("id, name, 'family' AS type")
                ->where('name', 'LIKE', $searchTerm) 
                ->get();
    }

}
