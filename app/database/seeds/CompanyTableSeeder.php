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
class CompanyTableSeeder extends Seeder
{
    //put your code here
    public function run()
    {
         DB::table('Company')->delete();
         
         $contactid = DB::table('Contact')->where('first_name', 'Greg')->pluck('id');
         Company::create(array( 'company_name' => 'Interactive Hardware',
                                'contact_id' => $contactid ));
         
         $contactid = DB::table('Contact')->where('first_name', 'Melanie')->pluck('id');
         Company::create(array( 'company_name' => 'New Homes Construction Co',
                                'contact_id' => $contactid ));
         
         $contactid = DB::table('Contact')->where('first_name', 'Todd')->pluck('id');
         Company::create(array( 'company_name' => 'Samples R Us Catering Co',
                                'contact_id' => $contactid ));
         
         $contactid = DB::table('Contact')->where('first_name', 'Esther')->pluck('id');
         Company::create(array( 'company_name' => 'CST Vehicle Rentals',
                                'contact_id' => $contactid ));
        
    }
    
}
