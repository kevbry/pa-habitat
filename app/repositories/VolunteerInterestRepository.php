<?php

namespace App\Repositories;

/**
 * Description of VolunteerRepository
 *
 * @author cst222
 */
interface VolunteerInterest {

    public function saveVolunteerInterest($volunteer);

    public function getVolunteerInterest($id);

    public function getVolunteerInterestsNonPaginated();
}
