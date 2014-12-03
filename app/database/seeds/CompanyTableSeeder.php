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
         
         Company::create(array('company_name' => 'Joe'));
         $contactid = DB::select('select id from contact where first_name = "Joe";');
         
         Company::create(array( 'comapny_name' => 'Joe',
                                'contact_id' => $contactid ));
        
    }
    
}
