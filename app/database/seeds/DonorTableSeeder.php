<?php
use App\Repositories\EloquentContactRepository;
class DonorTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        $contactRepo = new EloquentContactRepository();
        $contacts = $contactRepo->getAllContactsForSeed();
        
        DB::table('Donor')->delete();
        
        $currContact = 0;
        
        foreach ($contacts as $contact) 
            {
                $contact = $contacts[$currContact];
                if ($contact % 3 == 0)
                {
                    echo "Adding Donor for Contact ID: " . 
                            $contact . ".\n";
                    Donor::create(array(
                            'id' => $contact
                    ));
                }
                $currContact++;
            }
    }

}

