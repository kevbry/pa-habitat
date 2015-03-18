<?php

namespace App\Repositories;

/**
 * Description of ProjectRolesRepository
 *
 * @author cst220
 */
interface ProjectRolesRepository {

    public function getRole($id);
    public function getAllRoles();
   
}
