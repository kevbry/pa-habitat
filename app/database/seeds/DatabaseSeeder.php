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
                
                // Runs the seeder for the Contact table.
		$this->call('ContactTableSeeder');
                $this->command->info('Contact table seeded!');
                
                // Interest, Skill, and Certification Seeders
                // Temporarily disabled until models and views are created
//                $this->call('InterestTableSeeder');
//                $this->command->info('Interest table seeded!');
//                $this->call('SkillTableSeeder');
//                $this->command->info('Skill table seeded!');
//                $this->call('CertificationTableSeeder');
//                $this->command->info('Certification table seeded!');
	}

}
