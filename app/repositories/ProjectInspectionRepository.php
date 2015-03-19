<?php
namespace App\Repositories;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

interface ProjectInspectionRepository 
{
    public function getInspectionsForProject($id);
    public function saveProjectInspection($projectInspection);
    public function getInspectionsForProjectNonPaginated($id);
}
