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
            // NOTE: This does not appear to work (Migrate throws an error in 
            // the console).
            // Instead, we have to run a raw database command as Laravel does 
            // not support altering existing columns. Keep that in mind - we 
            // may encounter issues putting restrictions on certain database 
            // columns we've already made because of this. If someone can get
            // this to work, that would be great - though this code will 
            // actually remove any data in this column. The DB command will not
            // cause data loss.
            // 
//		Schema::table('Volunteer', function($table)
//                {
//                    $table->dropColumn('last_attended_safety_meeting_date');
//                    $table->date('last_attended_safety_meeting_date')->nullable();
//                });
            
            DB::statement('ALTER TABLE `habitat_Volunteer` MODIFY `last_attended_safety_meeting_date` DATE NULL;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
//		Schema::table('Volunteer', function($table)
//                {
//                    $table->dropColumn('last_attended_safety_meeting_date');
//                    $table->date('last_attended_safety_meeting_date');
//                });
            DB::statement('ALTER TABLE `habitat_Volunteer` MODIFY `last_attended_safety_meeting_date` DATE NOT NULL;');
	}

}
