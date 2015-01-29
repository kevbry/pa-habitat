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
    
    
    public function orderBy($sortby, $order) {
        
        $order = ($order == 'a' ? 'asc' : 'desc');

        switch ($sortby) {
            case 'f':
                $sortby = 'first_name';
                break;
            case 'h':
                $sortby = 'home_phone';
                break;
            case 'e':
                $sortby = 'email_address';
                break;
        }
            
        return \Contact::orderBy($sortby, $order)->paginate(20);
    }
}
