<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectContact
 *
 * @author cst217, cst 220
 */
class ProjectContact extends \Eloquent 
{
   	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ProjectContact';
        protected $with = array('project', 'contact', 'role');

	/**
	 * The attributes that are mass-assignment
	 *
	 * @fillable array with column names we wish to be able to assign to.
	 */
        protected $fillable = array('contact_id',
                                    'project_id',
                                    'role_id',
                                    'notes');
        
        /*
         * return Response
         */
        public function project()
        {
           return $this->hasOne('Project', 'id', 'project_id');           
        }
        
        /*
         * return Response
         */
        public function contact()
        {
            return $this->hasOne('Contact', 'id', 'contact_id');
        }
        
        public function role()
        {
            return $this->hasOne('ProjectRoles', 'id', 'role_id');
        }
        
}
