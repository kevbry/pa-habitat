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
        
        User::create([
            'contact_id' => $contacts[0]->id,
            'password'  => Hash::make('password'),
            'username' => 'admin',
            'access_level' => 'administrator'
        ]);
    }

}

