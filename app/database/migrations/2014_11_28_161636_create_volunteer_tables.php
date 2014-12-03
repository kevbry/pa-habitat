<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVolunteerTables extends Migration {

	/**
	 * Runs a set of migrations meant to create the volunteer and supporting
         * associated tables.
	 *
	 * @return void
	 */
	public function up()
	{
            // Rename the contact table to 'Contact' to meet the ERD conventions
            
            Schema::rename('contact', 'Contact');
            
            // Creates the volunteer table.
            // Includes reference to ID primary key in Contact table.
            
            Schema::create('Volunteer', function(Blueprint $table)
            {
                $table->integer('id')->unsigned();
                $table->foreign('id')->references('id')->on('Contact');
                $table->timestamps();
                $table->boolean('active_status');
                $table->date('last_attended_safety_meeting_date');
            });
            
            // Creates supporting tables for interests, certifications, skills

            Schema::create('Certification', function(Blueprint $table)
            {
                $table->increments('id');
                $table->timestamps();
                $table->string('cert_name');
            });

            Schema::create('Interest', function(Blueprint $table)
            {
                $table->increments('id');
                $table->timestamps();
                $table->string('description');
            });

            Schema::create('Skill', function(Blueprint $table)
            {
                $table->increments('id');
                $table->timestamps();
                $table->string('description');
            });

            Schema::create('Trade', function(Blueprint $table)
            {
                $table->increments('id');
                $table->timestamps();
                $table->string('trade_name');
            });

            // Creates joining tables between Volunteer and Skills/Trades/
            // Certifications, etc.

            Schema::create('VolunteerCertification', function(Blueprint $table)
            {
                $table->integer('volunteer_id')->unsigned();
                $table->foreign('volunteer_id')->references('id')->on('Volunteer');
                $table->integer('certification_id')->unsigned();
                $table->foreign('certification_id')->references('id')->on('Certification');
                $table->date('cert_earned_date');
                $table->date('cert_expiry_date');
                $table->string('comment');
                $table->primary(array('volunteer_id', 'certification_id'));
                $table->timestamps();
            });

            Schema::create('VolunteerInterest', function(Blueprint $table)
            {
                $table->integer('volunteer_id')->unsigned();
                $table->foreign('volunteer_id')->references('id')->on('Volunteer');
                $table->integer('interest_id')->unsigned();
                $table->foreign('interest_id')->references('id')->on('Interest');
                $table->string('comments');
                $table->primary(array('volunteer_id', 'interest_id'));
                $table->timestamps();
            });

            Schema::create('VolunteerSkill', function(Blueprint $table)
            {
                $table->integer('volunteer_id')->unsigned();
                $table->foreign('volunteer_id')->references('id')->on('Volunteer');
                $table->integer('skill_id')->unsigned();
                $table->foreign('skill_id')->references('id')->on('Skill');
                $table->string('comments');
                $table->integer('yearsExperience')->unsigned();
                $table->primary(array('volunteer_id', 'skill_id'));
                $table->timestamps();
            });

            Schema::create('VolunteerTrades', function(Blueprint $table)
            {
                $table->integer('volunteer_id')->unsigned();
                $table->foreign('volunteer_id')->references('id')->on('Volunteer');
                $table->integer('trade_id')->unsigned();
                $table->foreign('trade_id')->references('id')->on('Trade');
                $table->string('comments');
                $table->primary(array('volunteer_id', 'trade_id'));
                $table->timestamps();
            });
            
            // Create availability table for volunteer availability management
            Schema::create('Availability', function(Blueprint $table)
            {
                $table->integer('volunteer_id')->unsigned();
                $table->foreign('volunteer_id')->references('id')->on('Volunteer');
                $table->primary('volunteer_id');
                $table->date('date');
                $table->time('time');
                $table->float('hours_available');
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
            Schema::rename('Contact', 'contact');
            
            Schema::drop('Availability');    
            Schema::drop('VolunteerCertification');
            Schema::drop('VolunteerInterest');
            Schema::drop('VolunteerSkill');
            Schema::drop('VolunteerTrades');
            Schema::drop('Certification');
            Schema::drop('Interest');
            Schema::drop('Skill');
            Schema::drop('Trade');
            Schema::drop('Volunteer');
	}

}
