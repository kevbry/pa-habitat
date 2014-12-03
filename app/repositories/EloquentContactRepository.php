<?php
namespace App\Repositories;

class EloquentContactRepository implements ContactRepository
{
    public function getContact($id)
    {
        return \Contact::find($id);
    }
    
    
    public function getAllContacts()
    {
        return \Contact::all();        
    }
    
    public function saveContact($contact)
    {      
        $contact->save();
    }
}
