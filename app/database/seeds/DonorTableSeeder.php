<?php

class DonorTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        DB::table('Donor')->delete();
        
        $contactid = DB::table('Contact')->where('first_name', 'Todd')->pluck('id');
         Donor::create(array('id' => $contactid ));
    }

}

