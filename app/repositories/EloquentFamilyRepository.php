<?php
namespace App\Repositories;

/**
 * Description of EloquentFamilyRepository
 *
 * @author cst220
 */
class EloquentFamilyRepository implements FamilyRepository
{
    public function getFamily($id)
    {
        return \Family::find($id);
    }
    
    public function getAllFamilies()
    {
        return \Family::paginate(20);
    }
    
    public function saveFamily($family)
    {
        $family->save();
    }
    
}