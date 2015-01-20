<?php

class VolunteerHours extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'VolunteeredHours';
    //protected $with = array('availability','certifications','trades','skills','interests','contact');
    
    /**
     * The attributes that are mass-assignment
     *
     * @fillable array with column names we wish to be able to assign to.
     */
    protected $fillable = array('id','volunteer_id', 'project_id', 'date_of_contribution', 'hours', 'paid_hours', 'family_id');
    
    public function project()
    {
        return $this->hasOne('Project','id','project_id');
    }
    
    public function volunteer()
    {
        return $this->hasOne('Volunteer','id','volunteer_id');
    }
}
