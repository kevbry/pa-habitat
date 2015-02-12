<?php

namespace App\Repositories;

/**
 * Description of VolunteerRepository
 *
 * @author cst222
 */
interface VolunteerRepository {

    public function getVolunteer($id);

    public function getAllVolunteers();

    public function saveVolunteer($volunteer);

    public function getVolunteerSearchInfo($filter);
    public function orderBy($sortby, $order);
}
