<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ProjectRole
 *
 */
class ProjectRoles extends \Eloquent 
{
   	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'ProjectRoles';

	/**
	 * The attributes that are mass-assignment
	 *
	 * @fillable array with column names we wish to be able to assign to.
	 */

        protected $fillable = array('role');
        
}
