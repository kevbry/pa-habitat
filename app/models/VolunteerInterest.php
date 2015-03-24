<?php

class VolunteerInterest extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'VolunteerInterest';
    protected $with = array('volunteer','interest');


    /**
     * The attributes that are mass-assignment
     *
     * @fillable array with column names we wish to be able to assign to.
     */
    protected $fillable = array('id','volunteer_id', 'interest_id', 'comments');
    
    public function volunteer()
    {
        return $this->hasOne('Volunteer','id','volunteer_id');
    }
      public function interest()
    {
        return $this->hasOne('Interest','id','interest_id');
    }
}
