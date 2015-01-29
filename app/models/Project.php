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

        protected $fillable = array('family_id',
                                    'blueprint_id',
                                    'build_number',            
                                    'project_name',
                                    'street_number',
                                    'postal_code',
                                    'city',
                                    'province',
                                    'start_date',
                                    'end_date',
                                    'comments',
                                    'building_permit_number',
                                    'building_permit_date',
                                    'mortgage_date');
        
        /**
         * 
         * @return Response
         */
        public function vounteerHours() 
        {
             return $this->hasMany('VolunteeredHours', 'vounteer_id', 'id');                       
        }
        
        
//        public function vounteerHours() 
//        {
//             return $this->hasMany('VolunteeredHours', 'vounteer_id', 'id');                       
//        }
}