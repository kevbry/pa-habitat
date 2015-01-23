<?php
namespace App\Repositories;
/**
 * Description of EloquentFamilyContactRepository
 *
 * @author cst222
 */
class EloquentFamilyContactRepository implements FamilyContactRepository
{
    public function getContactsInFamily($id)
    {
        return \FamilyContact::find($id);
    }
    
    
    public function getFamilyByContact($id)
    {
        return \FamilyContact::find($id);
    }
    
    
    public function saveFamilyContact($familycontact)
    {
        $familycontact->save();
    }
}
