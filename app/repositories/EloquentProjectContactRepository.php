<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Repositories;

/**
 * Description of EloquentProjectContactRepository
 *
 * @author cst217
 */
class EloquentProjectContactRepository implements ProjectContactRepository
{
    /**
     * 
     * @param type $id
     * @return type Response
     */
    public function getProjectContact($id)
    {
        return \ProjectContact::find($id);
        
    }
    
    /**
     * 
     * @param type $id
     * @return type Response
     */
    public function getAllContactsByProject($id)
    {
        return \ProjectContact::find($id);
    }
    
    /**
     * 
     * @param type $projectContact
     */
    public function saveProjectContact($projectContact)
    {
        $projectContact->save();       
    }
}
