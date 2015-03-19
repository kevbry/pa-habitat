<?php

namespace App\Repositories;

class EloquentProjectInspectionRepository implements ProjectInspectionRepository 
{
    public function getInspectionsForProject($id) 
    {
        return \ProjectInspection::whereRaw('project_id =' . $id)->orderBy('date', 'asc')->paginate(20);
    }

    public function saveProjectInspection($projectInspection) 
    {
        $projectInspection->save();
    }
    public function getInspectionsForProjectNonPaginated($id)
    {
        return \ProjectInspection::whereRaw('project_id =' . $id)->orderBy('date', 'asc')->get();
    }
}
