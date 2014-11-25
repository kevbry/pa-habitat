<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CompanyTableSeeder
 *
 * @author cst217
 */
class CompanyTableSeeder extends Seeder implements ContactTableSeeder
{
    //put your code here
    public function run()
    {
         DB::table('contact')->delete();
         
         Contact::create(array('first_name' => 'Joe', 
                                'last_name' => 'Lovelace', 
                                'email_address' => 'joe@test.com',
                                'home_phone' => '', 
                                'cell_phone' => '306-927-3782', 
                                'work_phone' => '306-832-4821', 
                                'street_address' => '1645 Greg blvd', 
                                'city' => 'Gregtopia', 
                                'province' => 'Fred', 
                                'postal_code' => 'G9F-6G3', 
                                'country' => 'Canada', 
                                'comments' => 'Is mostly a Joe.'));
         $contactid = DB::select('select id from contact where first_name = "Joe" AND last_name = "Lovelace"');
         
         Company::create(array( 'comapny_name' => 'Fake cop',
                                'contact_id' => $contactid ));
        
    }
    
}
