<?php
use App\Repositories\EloquentContactRepository;

class VolunteerTableSeeder extends Seeder 
{
//    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 'active_status', 'last_attended_safety_meeting_date'
     */
    public function run()
    {
        $contactRepo = new EloquentContactRepository();
        $contacts = $contactRepo->getAllContactsForSeed();
        $currContact = 0;
        DB::table('Volunteer')->delete();
        
        $volunteerJson = File::get(storage_path() . "/jsondata/volunteer.json");
		$volunteers = json_decode($volunteerJson);
		foreach ($volunteers as $volunteer) 
                    {
                        $contact = $contacts[$currContact];
                        if ($contact % 2 == 0)
                        {
                            echo "Adding Volunteer for Contact ID: " . 
                                    $contact . ".\n";
                            Volunteer::create(array(
                                    'active_status' => array_rand(array(True, False)),
                                    'last_attended_safety_meeting_date' => $volunteer->last_attended_safety_meeting_date,
                                    'id' => $contact
                            ));
                        }
                        $currContact++;
                    }
    }
}

