<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyTables extends Migration {

	/**
	 * Runs a set of migrations meant to create the family and supporting
         * associated tables..
	 *
	 * @return void
	 */
	public function up()
	{
            // Creates the Family table.           
            Schema::create('Family', function(Blueprint $table)
            {
                $table->integer('id')->unsigned();
                $table->timestamps();
                $table->string('name');
                $table->string('status');
                $table->string('comments');
            });
            
            //Creates the FamilyContact table
            Schema::create('FamilyContact', function(Blueprint $table)
            {
                $table->integer('family_id')->unsigned();
                $table->foreign('family_id')->references('id')->on('Family');
                $table->integer('contact_id')->unsigned();
                $table->foreign('contact_id')->references('id')->on('Contact');
                $table->boolean('primary');
                $table->boolean('currently_active');
                $table->primary(array('family_id', 'contact_id'));
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
            Schema::dropIfExists('FamilyContact');
            Schema::dropIfExists('Family');
	}

}
