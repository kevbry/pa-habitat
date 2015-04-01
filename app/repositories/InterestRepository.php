<?php

namespace App\Repositories;

/**
 * Description of ProjectRolesRepository
 *
 * @author cst220
 */
interface InterestRepository {

    public function getInterest($id);

    public function getAllInterests();
}
