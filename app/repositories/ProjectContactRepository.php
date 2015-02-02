<?php
namespace App\Repositories;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectContact Repository
 * @author cst217
 */
interface ProjectContactRepository {

    public function getProjectContact($id);
    public function getAllContactsByProject();
    public function saveProjectContact($projectContact);
}
