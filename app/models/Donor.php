<?php

class Donor extends \Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Donor';

	/**
	 * The attributes that are mass-assignment
	 *
	 * @fillable array with column names we wish to be able to assign to.
	 */

        protected $fillable = array('id');
        
        public function contact()
        {
            return $this->belongsTo('Contact','id', 'id');
        }
}