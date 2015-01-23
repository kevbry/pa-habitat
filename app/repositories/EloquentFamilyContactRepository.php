<?php
namespace App\Repositories;
/**
 * Description of EloquentFamilyContactRepository
 *
 * @author cst222
 */
class EloquentFamilyContactRepository implements FamilyContactRepository
{
    public function getActiveContactsInFamily($family_id)
    {
        return \FamilyContact::query()
                ->select('Contact.first_name', 'Contact.last_name', 'primary', 'Contact.id')
                ->join('Contact', 'contact_id', '=', 'Contact.id')
                ->where('family_id', '=', $family_id)
                ->where('currently_active', '=', true)
                ->orderBy('primary', 'desc')
                ->get();
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
