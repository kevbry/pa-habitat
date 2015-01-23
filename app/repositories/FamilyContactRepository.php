<?php
namespace App\Repositories;

/**
 * Description of FamilyContactRepository
 *
 * @author cst220
 */
interface FamilyContactRepository {
    
    public function getActiveContactsInFamily($id);
    public function getFamilyByContact($id);
    public function saveFamilyContact($familycontact);
}
