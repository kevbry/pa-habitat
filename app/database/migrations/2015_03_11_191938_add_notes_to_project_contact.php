<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNotesToProjectContact extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            //Add this field to the projectcontact table
            Schema::table('ProjectContact', function($table)
            {
                $table->string('notes', 1024);
            });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
            //delete this field from the projectcontact table
            Schema::table('ProjectContact', function($table)
            {
                $table->dropColumn('notes');
            });
	}

}
