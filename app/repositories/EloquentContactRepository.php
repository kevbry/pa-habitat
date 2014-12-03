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
        return \Contact::orderBy('last_name','asc')->paginate(20);        
    }
    
    /**
     * Purpose: Save contact information to the database
     * @param Contact $contact A contact object to save to the database
     */
    public function saveContact($contact)
    {
        $contact->save();
    }
}
