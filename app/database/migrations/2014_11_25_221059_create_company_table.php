<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('company', function(Blueprint $table)
		{
			//Create comapny table and assign a foreign key 
                    //to contact Id.
                    $table->increments('id');
                    $table->string('company_name');
                    $table->integer('contact_id');
                    $table->foreign('contact_id')->references('id')->on('contact');
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
		Schema::table('company', function(Blueprint $table)
		{
			//
                    Schema::drop('company');
		});
	}

}
