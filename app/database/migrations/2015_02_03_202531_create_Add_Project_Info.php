<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddProjectInfo extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('Blueprint', function(Blueprint $table)
            {
                   $table->increments('id');
                   $table->string('plan_number');
                   $table->string('designer');
                   $table->timestamps();
            });
            
            
            Schema::table('Project', function(Blueprint $table)
            {
                $table->integer('family_id')->unsigned()->nullable();
                $table->foreign('family_id')->references('id')->on('Family');
                $table->integer('blueprint_id')->unsigned()->nullable();
                $table->string('build_number');
                $table->foreign('blueprint_id')->references('id')->on('Blueprint');
                $table->renameColumn('name','project_name');
                $table->string('street_number');
                $table->string('postal_code');
                $table->string('city');
                $table->string('province')->nullable();
                $table->date('start_date');
                $table->date('end_date')->nullable();
                $table->string('comments')->nullable();
                $table->string('building_permit_number');
                $table->string('building_permit_date');
                $table->string('mortgage_date');
            });
            
            Schema::create('ProjectContact', function(Blueprint $table)
            {
                $table->integer('project_id')->unsigned();
                $table->foreign('project_id')->references('id')->on('Project');
                $table->integer('contact_id')->unsigned();
                $table->foreign('contact_id')->references('id')->on('Contact');
                $table->string('role');
                $table->primary(array('project_id','contact_id'));
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
		//
            Schema::dropIfExists('ProjectContact');
            
            Schema::table('Project', function(Blueprint $table)
            {
                $table->dropForeign('project_family_id_foreign');
                $table->dropColumn('family_id');
                $table->dropColumn('build_number');
                $table->dropForeign('project_blueprint_id_foreign');
                $table->dropColumn('blueprint_id');
                $table->renameColumn('project_name','name');
                $table->dropColumn('street_number');
                $table->dropColumn('postal_code');
                $table->dropColumn('city');
                $table->dropColumn('province');
                $table->dropColumn('start_date');
                $table->dropColumn('end_date');
                $table->dropColumn('comments');
                $table->dropColumn('building_permit_number');
                $table->dropColumn('building_permit_date');
                $table->dropColumn('mortgage_date');
            });
            Schema::dropIfExists('Blueprint');
	}

}
