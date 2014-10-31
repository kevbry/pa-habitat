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
    
    public function saveContact($contact, $values)
    {
//        $contact->firstName = $values['firstName'];
//        $contact->lastName = $values['lastName'];
//        $contact->email_address = $values['emailAddress'];
//        $contact->home_phone = $values['homePhone'];
//        $contact->cell_phone = $values['cellPhone'];
//        $contact->work_phone = $values['workPhone'];
//        $contact->street_address = $values['streetNo'];
//        $contact->city = $values['city'];
//        $contact->province = $values['province'];
//        $contact->postal_code = $values['postalCode'];
//        $contact->country = $values['country'];
//        $contact->comments = $values['comments'];
        
        $contact->save();
    }
}
