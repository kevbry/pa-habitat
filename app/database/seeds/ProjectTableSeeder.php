<?php

class ProjectTableSeeder extends Seeder 
{
    
    /**
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     */
    public function run()
    {
        DB::table('Project')->delete();
        
        Project::create(array(  'project_name' => '123 Generic Street',
                                'street_number' => '32-A 1st Ave.',
                                'postal_code' => 'S9K-4T5',
                                'province' => 'Saskatchewan',
                                'start_date' => 'start_date',
                                'end_date' => 'end_date',
                                'family_id' => 2,
                                'coordinator' => 'coordinator'));
        Project::create(array(  'project_name' => 'Town Expansion Project',
                                'street_number' => '32-C 1st Ave.',
                                'postal_code' => 'S9K-4T5',
                                'province' => 'Saskatchewan',
                                'start_date' => 'start_date',
                                'end_date' => '',
                                'family_id' => 3,
                                'coordinator' => 'coordinator'));
        Project::create(array(  'project_name' => 'Butterfly Habitat Project',
                                'street_number' => '555 Fake street',
                                'postal_code' => 'S5T 1G9',
                                'province' => 'Saskatchewan',
                                'start_date' => '1996-12-01',
                                'end_date' => '',
                                'family_id' => 1,
                                'coordinator' => 'coordinator'));  
    }

}

