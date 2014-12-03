<?php

class SkillTableSeeder extends Seeder 
{
    
    /**
     * NOTE: This data should be kept accurate and up to date for production 
     * usage.
     * 
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     * Template Interest:
     * Skill::create(array(  'description' => '' ));
     */
    public function run()
    {
        DB::table('Skill')->delete();
        
        //Construction
        Skill::create(array(  'description' => 'Construction - Boarder'));
        Skill::create(array(  'description' => 'Construction - Carpenter'));
        Skill::create(array(  'description' => 'Construction - Drywaller'));
        Skill::create(array(  'description' => 'Construction - Electrician'));
        Skill::create(array(  'description' => 'Construction - Insulator'));
        Skill::create(array(  'description' => 'Construction - Gas Fitter'));
        Skill::create(array(  'description' => 'Construction - Mechanical'));
        Skill::create(array(  'description' => 'Construction - Painter'));
        Skill::create(array(  'description' => 'Construction - Plumber'));
        Skill::create(array(  'description' => 'Construction - Roofer'));
        Skill::create(array(  'description' => 'Construction - Steamfitter - Pipefitter'));
        Skill::create(array(  'description' => 'Construction - Other - Specify'));
        
        //Retail/ReStore
        Skill::create(array(  'description' => 'Retail/ReStore - Appliance Testing/Repair'));
        
        //Admin 
        Skill::create(array(  'description' => 'Admin - Accounting/Bookkeeping'));
        Skill::create(array(  'description' => 'Admin - Database Administration'));
        Skill::create(array(  'description' => 'Admin - Data Entry'));
        Skill::create(array(  'description' => 'Admin - Public Relations'));
        Skill::create(array(  'description' => 'Admin - Other - Specify'));
        
    }

}

