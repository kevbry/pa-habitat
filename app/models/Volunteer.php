<?php

class Volunteer extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Volunteer';
    
    /**
     * The attributes that are mass-assignment
     *
     * @fillable array with column names we wish to be able to assign to.
     */
    protected $fillable = array('id', 'active_status', 'last_attended_safety_meeting_date');
}
