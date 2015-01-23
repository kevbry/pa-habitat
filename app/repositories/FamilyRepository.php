<?php
namespace App\Repositories;
/**
 * Description of FamilyRepository
 *
 * @author cst220
 */
interface FamilyRepository {
    
    public function getFamily($id);
    public function getAllFamilies();
    public function saveFamily($family);
    public function showHoursContributedToFamily($family_id);
}
