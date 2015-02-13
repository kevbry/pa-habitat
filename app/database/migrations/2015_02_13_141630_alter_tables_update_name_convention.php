<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTablesUpdateNameConvention extends Migration {

	/**
	 * Run the migrations.
	 *
         * This Migration will run to standardize all the database tables that
         * hold a "name" field to follow the Laravel standard of leaving out
         * the table name in the field name - IE, to change them to "name"
         * instead of project/business/certification/trade name.
         * 
         * Again, Laravel does not have an easy way to alter existing database
         * fields without using a raw query.
	 * @return void
	 */
	public function up()
	{
		DB::statement('ALTER TABLE `habitat_Company` CHANGE company_name name VARCHAR(255);');
                DB::statement('ALTER TABLE `habitat_Certification` CHANGE cert_name name VARCHAR(255);');
                DB::statement('ALTER TABLE `habitat_Trade` CHANGE trade_name name VARCHAR(255);');
                DB::statement('ALTER TABLE `habitat_Project` CHANGE project_name name VARCHAR(255);');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement('ALTER TABLE `habitat_Company` CHANGE name company_name  VARCHAR(255);');
                DB::statement('ALTER TABLE `habitat_Certification` CHANGE name cert_name VARCHAR(255);');
                DB::statement('ALTER TABLE `habitat_Trade` CHANGE name trade_name VARCHAR(255);');
                DB::statement('ALTER TABLE `habitat_Project` CHANGE name project_nameVARCHAR(255);');
	}

}
