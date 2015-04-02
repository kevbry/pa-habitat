<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProjectFamilyId extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            DB::statement('ALTER TABLE `habitat_Project` MODIFY `family_id` int(10) unsigned NULL;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            DB::statement('ALTER TABLE `habitat_Project` MODIFY `family_id` int(10) unsigned DEFAULT NULL;');
	}

}
