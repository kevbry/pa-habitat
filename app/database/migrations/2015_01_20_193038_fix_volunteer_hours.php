<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixVolunteerHours extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::dropIfExists('VolunteeredHours');
            
            Schema::create('VolunteerHours', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('volunteer_id')->unsigned();
                $table->foreign('volunteer_id')->references('id')->on('Volunteer');
                $table->integer('project_id')->unsigned();
                $table->foreign('project_id')->references('id')->on('Project');
                $table->integer('family_id')->unsigned()->nullable();
                $table->foreign('family_id')->references('id')->on('Family');
                $table->date('date_of_contribution');
                $table->boolean('paid_hours')->nullable();
                $table->integer('hours')->nullable();
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
            Schema::dropIfExists('VolunteerHours');
             
            Schema::create('VolunteeredHours', function(Blueprint $table)
            {
                $table->integer('volunteer_id')->unsigned();
                $table->foreign('volunteer_id')->references('id')->on('Volunteer');
                $table->integer('project_id')->unsigned();
                $table->foreign('project_id')->references('id')->on('Project');
                $table->integer('family_id')->nullable();
                $table->date('date_of_contribution');
                $table->boolean('paid_hours')->nullable();
                $table->integer('hours')->nullable();
                $table->primary(array('volunteer_id', 'project_id'));
                $table->timestamps();
            });
	}

}
