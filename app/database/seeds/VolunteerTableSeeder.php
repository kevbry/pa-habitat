<?php

class VolunteerTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 'active_status', 'last_attended_safety_meeting_date'
     */
    public function run()
    {
        DB::table('Volunteer')->delete();
        
        $contactid = DB::table('Contact')->where('first_name', 'Greg')->pluck('id');
        Volunteer::create(array(  'id' => $contactid,
                                  'active_status' => true,
                                  'last_attended_safety_meeting_date' => '2014-12-04'));
        $contactid = DB::table('Contact')->where('first_name', 'Melanie')->pluck('id');
        Volunteer::create(array(  'id' => $contactid,
                                  'active_status' => false));
    }

}

