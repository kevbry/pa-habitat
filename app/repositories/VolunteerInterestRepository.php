<?php

namespace App\Repositories;

/**
 * Description of VolunteerRepository
 *
 * @author cst222
 */
interface VolunteerInterestRepository 
{

    public function getVolunteerInterests($id);
    
    public function saveVolunteerInterest($volunteer);

    public function getVolunteerInterestsNonPaginated($id);
    
    public function deleteVolunteerInterests($id);
    
    public function getVolunteerInterestsAsArray($id);
}
