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
        return \Contact::orderBy('first_name','asc')->paginate(20);        
    }
    
    public function getAllContactsNonPaginated()
    {
        return \Contact::orderBy('first_name','asc')->get();        
    }
    
    public function getAllContactsForSeed()
    {
        return \Contact::lists('id');      
    }
    
    /**
     * Purpose: Save contact information to the database
     * @param Contact $contact A contact object to save to the database
     */
    public function saveContact($contact)
    {
        $contact->save();
    }
    
    
    public function orderBy($sort, $order) {
        
        $order = ($order == 'a' ? 'asc' : 'desc');

        
        switch ($sort) {
            case 'l':
                $sortby = 'first_name';
                break;
            case 'e':
                $sortby = 'email_address';
                break;
        }
            
        return \Contact::orderBy($sortby, $order)->paginate(20);
    }
    
    
    
    public function getContactSearchInfo($filter)
    {
        $searchTerm = "%" . $filter . "%";
        
        return \Contact::query()
                ->selectRaw("id, CONCAT(first_name, ' ', last_name) AS name, 'contact' AS type")
                ->where('first_name', 'LIKE', $searchTerm)
                ->orWhere('last_name', 'LIKE', $searchTerm)
                ->get();
    }
}
