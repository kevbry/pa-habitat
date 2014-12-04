<?php

class Contact extends \Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Contact';

	/**
	 * The attributes that are mass-assignment
	 *
	 * @fillable array with column names we wish to be able to assign to.
	 */

        protected $fillable = array('first_name', 
                                    'last_name', 
                                    'email_address',
                                    'home_phone', 
                                    'cell_phone', 
                                    'work_phone', 
                                    'street_address', 
                                    'city', 
                                    'province', 
                                    'postal_code', 
                                    'country', 
                                    'comments');
        
          public function volunteer()
        {
            return $this->hasOne('Volunteer','id', 'id');
        }
}