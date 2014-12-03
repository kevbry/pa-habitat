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
        
        Contact::create(array(  'first_name' => 'Greg', 
                                'last_name' => 'Smith', 
                                'email_address' => 'greg@test.com',
                                'home_phone' => '306-382-3823', 
                                'cell_phone' => '306-927-3782', 
                                'work_phone' => '306-832-4821', 
                                'street_address' => '1645 Greg blvd', 
                                'city' => 'Gregtopia', 
                                'province' => 'Fred', 
                                'postal_code' => 'G9F-6G3', 
                                'country' => 'Canada', 
                                'comments' => 'Is mostly a Greg.'));
        
        Contact::create(array(  'first_name' => 'Todd', 
                                'last_name' => 'Gregory', 
                                'email_address' => 'todd@test.com',
                                'home_phone' => '306-435-4561', 
                                'cell_phone' => '306-951-7821', 
                                'work_phone' => '306-934-9874', 
                                'street_address' => '32-A 1st Ave.', 
                                'city' => 'Saskatoon', 
                                'province' => 'Saskatchewan', 
                                'postal_code' => 'S9K-4T5', 
                                'country' => 'Canada', 
                                'comments' => 'Likes to work at night.'));
        
        Contact::create(array(  'first_name' => 'Melanie', 
                                'last_name' => 'Frank', 
                                'email_address' => 'mel@test.com',
                                'home_phone' => '306-435-4562', 
                                'cell_phone' => '306-951-7823', 
                                'work_phone' => '306-934-9879', 
                                'street_address' => '32-B 1st Ave.', 
                                'city' => 'Saskatoon', 
                                'province' => 'Saskatchewan', 
                                'postal_code' => 'S9K-4T5', 
                                'country' => 'Canada', 
                                'comments' => 'Likes to work weekends.'));
        
        Contact::create(array(  'first_name' => 'Esther', 
                                'last_name' => 'Whitaker', 
                                'email_address' => 'ess@test.com',
                                'home_phone' => '306-435-4565', 
                                'cell_phone' => '306-951-7831', 
                                'work_phone' => '306-934-9847', 
                                'street_address' => '32-C 1st Ave.', 
                                'city' => 'Saskatoon', 
                                'province' => 'Saskatchewan', 
                                'postal_code' => 'S9K-4T5', 
                                'country' => 'Canada', 
                                'comments' => 'Bad around fire.'));
    }

}

