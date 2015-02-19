<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MoveBlueprintDataToProjectTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::table('Project', function($table)
            {
                //delete this field from the project table
                $table->dropForeign('project_blueprint_id_foreign');
                $table->dropColumn('blueprint_id');
                
                //Add these fields to the project table
                $table->string('blueprint_plan_number');
                $table->string('blueprint_designer');
                
            });
            
            Schema::dropIfExists('Blueprint');
            
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::create('Blueprint', function(Blueprint $table)
            {
                   $table->increments('id');
                   $table->string('plan_number');
                   $table->string('designer');
                   $table->timestamps();
            });
            
            Schema::table('Project', function($table)
            {
                //Create the blueprint_id field in the project table
                $table->integer('blueprint_id')->unsigned()->nullable();
                $table->foreign('blueprint_id')->references('id')->on('Blueprint');
                
                //Drop these fields from the project table
                $table->dropColumn('blueprint_plan_number');
                $table->dropColumn('blueprint_designer');
                
            });
	}

}
