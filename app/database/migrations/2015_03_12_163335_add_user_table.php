<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserTable extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('User', function(Blueprint $table)
        {
            $table->integer('contact_id')->unsigned()->unique();
            $table->foreign('contact_id')->references('id')->on('Contact');
            $table->string('password');
            $table->string('username');
            $table->string('remember_token')->nullable();
            $table->string('access_level')->default('basic_user');
            $table->timestamps();
            $table->primary('contact_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('User');
    }

}
