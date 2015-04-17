<?php
use App\Repositories\EloquentContactRepository;

class UserTableSeeder extends Seeder 
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
        DB::table('User')->delete();
        
        Contact::create(array(
                'id'        => 30000,
                'first_name' => 'Administrator', 
                'last_name' => 'Prince Albert', 
                'comments' => 'This is the default administrator contact'
        ));
        User::create([
            'contact_id' => 30000,
            'password'  => Hash::make('password'),
            'username' => 'admin',
            'access_level' => 'administrator'
        ]);
    }

}

