<?php

class ContactTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     * Template Contact:
     * Contact::create(array(  'first_name' => '', 
                                'last_name' => '', 
                                'email_address' => '',
                                'home_phone' => '',
                                'cell_phone' => '', 
                                'work_phone' => '', 
                                'street_address' => '', 
                                'city' => '', 
                                'province' => '', 
                                'postal_code' => '', 
                                'country' => '', 
                                'comments' => ''));
     */
    public function run()
    {
        DB::table('Contact')->delete();
        
        $contactJson = File::get(storage_path() . "/jsondata/contact.json");
		$contacts = json_decode($contactJson);
		foreach ($contacts as $contact) {
                    echo "Adding Contact: " . $contact->first_name . " " . 
                            $contact->last_name . ".\n";
			Contact::create(array(
				'first_name' => $contact->first_name, 
                                'last_name' => $contact->last_name, 
                                'email_address' => $contact->email_address,
                                'home_phone' => $contact->home_phone,
                                'cell_phone' => $contact->cell_phone, 
                                'work_phone' => $contact->work_phone, 
                                'street_address' => $contact->street_address, 
                                'city' => "Prince Albert", 
                                'province' => "SK", 
                                'postal_code' => $contact->postal_code, 
                                'country' => "Canada", 
                                'comments' => $contact->comments
			));
		}
    }

}

