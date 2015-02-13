<?php
use App\Repositories\EloquentContactRepository;
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
        $contactRepo = new EloquentContactRepository();
        $contacts = $contactRepo->getAllContactsForSeed();
        DB::table('Company')->delete();
        $companyJson = File::get(storage_path() . "/jsondata/company.json");
		$companies = json_decode($companyJson);
		foreach ($companies as $company) 
                    {
                        $contact = array_rand($contacts);
                        echo "Adding Company: " . $company->company_name . 
                                " with contact ID: $contacts[$contact].\n";
			Company::create(array(
				'name' => $company->company_name, 
                                'contact_id' => $contacts[$contact]
			));
                    }
    }
    
}
