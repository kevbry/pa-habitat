<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingProjectItemTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
            Schema::create('ProjectItem', function(Blueprint $table)
            {
                $table->increments('id');
                $table->integer('project_id')->unsigned();
                $table->foreign('project_id')->references('id')->on('Project');
                $table->string('item_type')->nullable();
                $table->string('manufacturer')->nullable();
                $table->string('model')->nullable();
                $table->string('serial_number')->nullable();
                $table->string('vendor')->nullable();
                $table->string('comments')->nullable();
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
            Schema::dropIfExists('ProjectItem');
	}

}
