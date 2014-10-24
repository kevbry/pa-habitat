<?php

<<<<<<< HEAD

class User extends Eloquent  {


=======
use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Contact extends Eloquent
{
>>>>>>> S1Testing
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'contact';

<<<<<<< HEAD

=======
	/**
	 * The attributes that are mass-assignment
	 *
	 * @fillable array with column names we wish to be able to assign to.
	 */

        protected $fillable = array('first_name', 'last_name', 'email');
>>>>>>> S1Testing
}
