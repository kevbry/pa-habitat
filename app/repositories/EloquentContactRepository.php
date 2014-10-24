<?php
namespace App\Repositories;

use Contact;

/**
 * Description of EloquentContactRepository
 *
 * @author cst222, cst210
 */
class EloquentContactRepository implements ContactRepository
{
    public function getContact($id)
    {
        return Contact::find($id);
    }
    
    
    public function getAllContacts()
    {
        return Contact::all();        
    }
    
    public function saveContact($data)
    {
        return Contact::create($data);
    }
}
