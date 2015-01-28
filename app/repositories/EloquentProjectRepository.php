<?php
namespace App\Repositories;

class EloquentProjectRepository implements ProjectRepository
{
    public function getProject($id)
    {
        return \Project::find($id);
    }
    
    
    public function getAllProjects()
    {
        return \Project::orderBy('name','asc')->paginate(20);        
    }
    
    /**
     * Purpose: Save project information to the database
     * @param Project $project A project object to save to the database
     */
    public function saveProject($project)
    {
        $project->save();
    }
    
    public function orderBy($sortby, $order) {
        
        $order = ($order == 'a' ? 'asc' : 'desc');

        switch ($sortby) {
            case 'n':
                $sortby = 'name';
                break;
        }
            
        return \Project::orderBy($sortby, $order)->paginate(20);
    }
}
