<?php
namespace App\Repositories;

/**
 * Description of ContactRepository
 *
 * @author cst222, cst210
 */
interface ProjectRepository 
{
    public function getProject($id);
    public function getAllProjects();
    public function saveProject($project);
    public function orderBy($sortby,$order);
}
