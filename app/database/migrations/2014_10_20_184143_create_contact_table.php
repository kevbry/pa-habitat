<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactTable extends Migration 
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Contact', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
                        $table->string("first_name");
                        $table->string("last_name");
                        $table->string("email_address");
                        $table->string("home_phone");
                        $table->string("cell_phone");
                        $table->string("work_phone");
                        $table->string("street_address");
                        $table->string("city");
                        $table->string("province");
                        $table->string("postal_code");
                        $table->string("country");
                        $table->string("comments");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contact');
		Schema::dropIfExists('Contact');
            Schema::dropIfExists('contact');
            Schema::dropIfExists('Contact');
	}
}
