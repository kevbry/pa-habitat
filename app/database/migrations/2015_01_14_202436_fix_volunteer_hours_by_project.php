<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixVolunteerHoursByProject extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('VolunteeredHours', function($table)
            {
                $table->dropColumn('volunteered_hours');

                $table->dropColumn('paid_hours');
                
            });

            Schema::table('VolunteeredHours', function($table)
            {
                $table->integer('hours')->nullable();
                
                $table->boolean('paid_hours');
                
                $table->integer('family_id')->nullable();
            });
            
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('VolunteeredHours', function($table)
            {
                $table->dropColumn('hours');
                
                $table->dropColumn('paid_hours');

                $table->dropColumn('family_id');
                
            });

            
            Schema::table('VolunteeredHours', function($table)
            {
                $table->integer('volunteered_hours')->nullable();
                $table->integer('paid_hours')->nullable();
            });
	}

}
