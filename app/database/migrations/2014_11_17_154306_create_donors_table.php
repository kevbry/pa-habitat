<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('Donor', function(Blueprint $table)
		{
                        $table->integer('id')->unsigned();
                        $table->foreign('id')->references('id')->on('Contact');
			$table->timestamps();
                        $table->string("business_name");
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('Donor');
	}

}
