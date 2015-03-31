<?php

class ProductionCertificationListSeeder extends Seeder 
{
    
    /**
     * NOTE: This data should be kept accurate and up to date for production 
     * usage.
     * 
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     * Template Interest:
     * Certification::create(array(  'name' => '' ));
     */
    public function run()
    {
        DB::table('Certification')->delete();
        
        Certification::create(array(  'name' => 'Safety CPR A' ));
        Certification::create(array(  'name' => 'Safety CPR B' ));
        Certification::create(array(  'name' => 'Safety CPR C' ));
        Certification::create(array(  'name' => 'Safety CPR HCP' ));
        Certification::create(array(  'name' => 'Safety Automated External Defibrilator' ));
        Certification::create(array(  'name' => 'Safety First Responder' ));
        Certification::create(array(  'name' => 'Safety Emergency Medical Responder' ));
        Certification::create(array(  'name' => 'Safety WHMIS' ));
        Certification::create(array(  'name' => 'Safety OH&S Level 1' ));
        Certification::create(array(  'name' => 'Safety Fall Arrest' ));
        Certification::create(array(  'name' => 'Scaffolding' ));
        Certification::create(array(  'name' => 'Equipment Loader' ));
        Certification::create(array(  'name' => 'Equipment Forklift' ));
        Certification::create(array(  'name' => 'Equipment SkidSteer' ));
        Certification::create(array(  'name' => 'Equipment Zoomboom' ));
        Certification::create(array(  'name' => 'Other - SPECIFY' ));
    }

}

