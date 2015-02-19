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
                
                //Runs the seeder for the Contact table.
		$this->call('ContactTableSeeder');
                $this->command->info('Contact table seeded!');
                $this->call('CompanyTableSeeder');
                $this->command->info('Company table seeded!');
                $this->call('VolunteerTableSeeder');
                $this->command->info('Volunteer table seeded!');
                $this->call('DonorTableSeeder');
                $this->command->info('Donor table seeded!');
                $this->call('FamilyTableSeeder');
                $this->command->info('Family table seeded!');
                $this->call('ProjectTableSeeder');
                $this->command->info('Project table seeded!');
                $this->call('VolunteerHoursTableSeeder');
                $this->command->info('VolunteerHours table seeded!');
                
                DB::statement('SET FOREIGN_KEY_CHECKS = 1');
	}

}
