<?php

namespace App\Repositories;

/**
 * Description of EloquentProjectRolesRepository
 *
 * @author cst220
 */
class EloquentProjectRolesRepository implements ProjectRolesRepository {

    public function getRole($id)
    {
        return \ProjectRoles::find($id);
    }
    
    public function getAllRoles()
    {
        return \ProjectRoles::orderBy('role','asc')->get();
    }

}
