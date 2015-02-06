<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectInspectionTable extends Migration {

	/**
	 * Run the migrations.
	 * Creates the ProjectInspection table, with all associated fields.
	 * @return void
	 */
	public function up()
	{
		Schema::create('ProjectInspection', function(Blueprint $table)
            {
                   $table->increments('id');
                   $table->integer('project_id')->unsigned();
                   $table->foreign('project_id')->references('id')->on('Project');
                   $table->boolean('mandatory');
                   $table->date('date');
                   $table->string('type');
                   $table->boolean('pass');
                   $table->string('comments');
                   $table->timestamps();
            });
	}

	/**
	 * Reverse the migrations.
	 * Drops the ProjectInspection table if it exists.
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('ProjectInspection');
	}

}
