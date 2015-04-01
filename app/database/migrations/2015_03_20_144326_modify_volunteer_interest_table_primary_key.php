<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyVolunteerInterestTablePrimaryKey extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::dropIfExists('VolunteerInterest');


        Schema::create('VolunteerInterest', function(Blueprint $table) {
            $table->integer('volunteer_id')->unsigned();
            $table->foreign('volunteer_id')->references('id')->on('Volunteer');
            $table->integer('interest_id')->unsigned();
            $table->foreign('interest_id')->references('id')->on('Interest');
            $table->string('comments');
            $table->increments('id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('VolunteerInterest');


        Schema::create('VolunteerInterest', function(Blueprint $table) {
            $table->integer('volunteer_id')->unsigned();
            $table->foreign('volunteer_id')->references('id')->on('Volunteer');
            $table->integer('interest_id')->unsigned();
            $table->foreign('interest_id')->references('id')->on('Interest');
            $table->string('comments');
            $table->primary(array('volunteer_id', 'interest_id'));
            $table->timestamps();
        });
    }

}
