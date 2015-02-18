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
         *  ADD family_id to fillable array
	 */
        protected $fillable = array('name',
                                    'family_id',
                                    'build_number',            
                                    'street_number',
                                    'postal_code',
                                    'city',
                                    'province',
                                    'start_date',
                                    'end_date',
                                    'comments',
                                    'building_permit_number',
                                    'building_permit_date',
                                    'mortgage_date',
                                    'blueprint_plan_number',
                                    'blueprint_designer');
        
        /**
         * 
         * @return Response
         */
        public function projectContact () 
        {
             return $this->hasMany('ProjectContact', 'project_id', 'id');                       
        }
        
        /**
         * 
         * @return type Response
         */
        public function family()
        {
            return $this->belongsTo('Family', 'family_id', 'id');
        }
        
}