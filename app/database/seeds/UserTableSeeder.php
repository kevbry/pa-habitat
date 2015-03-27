<?php

class UserTableSeeder extends Seeder 
{
//    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 'active_status', 'last_attended_safety_meeting_date'
     */
    public function run()
    {
        DB::table('User')->delete();
        
        User::create([
            'contact_id' => 25,
            'password'  => Hash::make('password'),
            'username' => 'admin',
            'access_level' => 'administrator'
        ]);
    }

}

