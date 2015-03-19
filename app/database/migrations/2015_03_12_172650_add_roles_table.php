<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('ProjectRoles', function(Blueprint $table)
            {
                $table->increments('id');
                $table->string('role');
                $table->timestamps();
            });
            
            Schema::table('ProjectContact', function($table)
            {
               $table->dropColumn('role');
               $table->integer('role_id')->unsigned();
               $table->foreign('role_id')->references('id')->on('ProjectRoles');
               $table->dropForeign('projectcontact_contact_id_foreign');
               $table->dropForeign('projectcontact_project_id_foreign');
               $table->dropPrimary('PRIMARY');
               $table->foreign('contact_id')->references('id')->on('Contact');
               $table->foreign('project_id')->references('id')->on('Project');
               $table->primary(array('contact_id', 'project_id', 'role_id'));         
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            Schema::table('ProjectContact', function($table)
            {
               $table->dropForeign('projectcontact_role_id_foreign');
               $table->dropColumn('role_id');
               $table->string('role');
            });
            
            Schema::dropIfExists('ProjectRoles');
	}

}
