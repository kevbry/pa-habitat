<?php

class DatabaseSeeder extends Seeder 
{

	/**
	 * The seeder is used to create demo data for the database.
         * This can be called through the command line by running
         *      php artisan db:seed
         * The format for calling a seeder class is as follows:
         *      $this->call('SEEDERCLASSNAME');
         *      $this->command->info('<tablename> table seeded!');
         * 
	 * The class names for seeders should follow this pattern:
         *      <tablename>TableSeeder
         * 
         * For information on how to create a database seeder, please see
         *      ContactTableSeeder.php.
         * All seeds should be created in the 'seeds' folder.
	 */
	public function run()
	{
		Eloquent::unguard();
                DB::statement('SET FOREIGN_KEY_CHECKS = 0');
                
                //These seeds will only run in local mode (development environment)
                if(App::environment('local'))
                {                                   
                    //Runs the seeder for the Contact table.
                    $this->command->info('Starting Demonstration Data Seeds:');
                    $this->command->info('Seeding Contact Table:');
                    $this->call('ContactTableSeeder');
                    $this->command->info('Contact table seeded!');
                    $this->command->info('Seeding Company Table:');
                    $this->call('CompanyTableSeeder');
                    $this->command->info('Company table seeded!');
                    $this->command->info('Seeding Volunteer Table:');
                    $this->call('VolunteerTableSeeder');
                    $this->command->info('Volunteer table seeded!');
                    $this->command->info('Seeding Donor Table:');
                    $this->call('DonorTableSeeder');
                    $this->command->info('Donor table seeded!');
                    $this->command->info('Seeding Family and FamilyContact Table:');
                    $this->call('FamilyTableSeeder');
                    $this->command->info('Family table seeded!');
                    $this->command->info('Seeding Project Table:');
                    $this->call('ProjectTableSeeder');
                    $this->command->info('Project table seeded!');
                    $this->command->info('Seeding ProjectItem Table:');
                    $this->call('ProjectItemsTableSeeder');
                    $this->command->info('ProjectItem table seeded!');
                    $this->command->info('Seeding ProjectInspection Table:');
                    $this->call('ProjectInspectionTableSeeder');
                    $this->command->info('ProjectInspection table seeded!');
                    $this->command->info('Seeding VolunteerHours Table:');
                    $this->call('VolunteerHoursTableSeeder');
                    $this->command->info('VolunteerHours table seeded!');
                    $this->command->info('Seeding ProjectContact Table:');
                    $this->call('ProjectContactTableSeeder');
                    $this->command->info('ProjectContact table seeded!');
                }
                
                
                $this->command->info('Adding the Project Role list:');
                $this->call('ProductionRoleListSeeder');
                $this->command->info('Finished adding Project Role list.');
                
                $this->command->info('Adding Interest List to Database:');
		$this->call('ProductionInterestListSeeder');
                $this->command->info('Interest added successfully!');
                
                $this->call('UserTableSeeder');
                $this->command->info("User table seeded!");
                
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
