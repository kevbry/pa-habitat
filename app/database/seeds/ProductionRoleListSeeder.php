<?php

class ProductionRoleListSeeder extends Seeder 
{
    
    public function run()
    {
        DB::table('ProjectRoles')->delete();
        
        ProjectRoles::create(array('role' => 'Project Coordinator'));
        ProjectRoles::create(array('role' => 'Plumber'));
        ProjectRoles::create(array('role' => 'Gas Fitter'));
        ProjectRoles::create(array('role' => 'Electrician'));
        ProjectRoles::create(array('role' => 'Carpenter'));
        ProjectRoles::create(array('role' => 'Contractor'));
        ProjectRoles::create(array('role' => 'Mechanical'));
        ProjectRoles::create(array('role' => 'Other'));
		
    }

}

