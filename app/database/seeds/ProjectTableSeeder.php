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
        
        Project::create(array(  'name' => '123 Generic Street'));
        Project::create(array(  'name' => 'Town Expansion Project'));
        Project::create(array(  'name' => 'Butterfly Habitat Project'));  
    }

}

