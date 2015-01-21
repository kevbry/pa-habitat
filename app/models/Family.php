<?php

class Family extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Family';

    /**
     * The attributes that are mass-assignment
     *
     * @fillable array with column names we wish to be able to assign to.
     */

    protected $fillable = array('name',
                                'status',
                                'comments');
    
    protected $with = array('familycontact', 'volunteerhours');
        
    public function familycontact()
    {
        return $this->hasMany('FamilyContact', 'family_id');
    }
    
    public function volunteerhours()
    {
        return $this->hasMany('VolunteerHours', 'family_id');
    }
}

