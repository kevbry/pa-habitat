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
		Schema::create('donor', function(Blueprint $table)
		{
                        $table->integer('contact_id');
			$table->timestamps();
                        $table->string("business_name");
		});
                Schema::table('donor', function(Blueprint $table)
                {
                    $table->foreign('contact_id')->references('contact_id')
                    ->on('contact')->onDelete('cascade'); 
                });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('donor');
	}

}
