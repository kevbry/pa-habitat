<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProjectName extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
           // Schema::dropIfExists('Project');
            Schema::create('Project', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('project_name');
                $table->string('street_number');
                $table->string('postal_code');
                $table->string('province');
                $table->date('start_date');
                $table->date('end_date')->nullable();
                $table->integer('family_id')->unsigned();
                $table->foreign('family_id')->references('family_id')->on('VolunteeredHours');
                $table->string('coordinator');
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
//		Schema::table('Project', function($table)
//                {
                    Schema::dropIfExists('Project');
                    Schema::dropIfExists('VolunteeredHours');
 //               });
	}

}
