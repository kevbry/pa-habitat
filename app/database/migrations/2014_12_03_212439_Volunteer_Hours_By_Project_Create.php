<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VolunteerHoursByProjectCreate extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            // Creating the project table
            // NOTE: This table is a temporary table for base functionality
            //  in the VolunteeredHours table. It will be overwritten in the
            //  future.
            //
            Schema::create('Project', function(Blueprint $table)
            {
                $table->increments('id');
                $table->timestamps();
            });
            
            Schema::create('VolunteeredHours', function(Blueprint $table)
            {
                $table->integer('volunteer_id')->unsigned();
                $table->foreign('volunteer_id')->references('id')->on('Volunteer');
                $table->integer('project_id')->unsigned();
                $table->foreign('project_id')->references('id')->on('Project');
                $table->date('date_of_contribution');
                $table->integer('paid_hours')->nullable();
                $table->integer('volunteered_hours')->nullable();
                $table->primary(array('volunteer_id', 'project_id'));
                $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::dropIfExists('VolunteeredHours');

            Schema::dropIfExists('Project');
	}

}
