<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVolunteerDateFieldNull extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('Volunteer', function($table)
                {
                    $table->dropColumn('last_attended_safety_meeting_date');
                    $table->date('last_attended_safety_meeting_date')->nullable();
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('Volunteer', function($table)
                {
                    $table->dropColumn('last_attended_safety_meeting_date');
                    $table->date('last_attended_safety_meeting_date');
                });
	}

}
