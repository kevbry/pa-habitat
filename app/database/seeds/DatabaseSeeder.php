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
	 */
	public function run()
	{
		Eloquent::unguard();
                
                // Runs the seeder for the Contact table.
		$this->call('ContactTableSeeder');
                $this->command->info('contact table seeded!');
	}

}
