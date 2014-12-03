<?php

class CertificationTableSeeder extends Seeder 
{
    
    /**
     * NOTE: This data should be kept accurate and up to date for production 
     * usage.
     * 
     * Format: MODELNAME::create(array('key' => 'value', ...));
     * 
     * Template Interest:
     * Certification::create(array(  'cert_name' => '' ));
     */
    public function run()
    {
        DB::table('Certification')->delete();
        
        Certification::create(array(  'cert_name' => 'Safety CPR A' ));
        Certification::create(array(  'cert_name' => 'Safety CPR B' ));
        Certification::create(array(  'cert_name' => 'Safety CPR C' ));
        Certification::create(array(  'cert_name' => 'Safety CPR HCP' ));
        Certification::create(array(  'cert_name' => 'Safety Automated External Defibrilator' ));
        Certification::create(array(  'cert_name' => 'Safety First Responder' ));
        Certification::create(array(  'cert_name' => 'Safety Emergency Medical Responder' ));
        Certification::create(array(  'cert_name' => 'Safety WHMIS' ));
        Certification::create(array(  'cert_name' => 'Safety OH&S Level 1' ));
        Certification::create(array(  'cert_name' => 'Safety Fall Arrest' ));
        Certification::create(array(  'cert_name' => 'Scaffolding' ));
        Certification::create(array(  'cert_name' => 'Equipment Loader' ));
        Certification::create(array(  'cert_name' => 'Equipment Forklift' ));
        Certification::create(array(  'cert_name' => 'Equipment SkidSteer' ));
        Certification::create(array(  'cert_name' => 'Equipment Zoomboom' ));
        Certification::create(array(  'cert_name' => 'Other - SPECIFY' ));
    }

}

