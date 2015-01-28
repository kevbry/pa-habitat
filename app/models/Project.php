<?php

class Project extends \Eloquent
{
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'Project';

	/**
	 * The attributes that are mass-assignment
	 *
	 * @fillable array with column names we wish to be able to assign to.
	 */

        protected $fillable = array('project_name',
                                    'street_number',
                                    'postal_code',
                                    'province',
                                    'start_date',
                                    'end_date',
                                    'family_id',
                                    'coordinator');
        
        /**
         * 
         * @return Response
         */
        public function vounteerHours() 
        {
             return $this->hasMany('VolunteeredHours', 'vounteer_id', 'id');                       
        }
        
}