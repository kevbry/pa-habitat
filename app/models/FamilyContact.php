<?php

class FamilyContact extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'FamilyContact';

    /**
     * The attributes that are mass-assignment
     *
     * @fillable array with column names we wish to be able to assign to.
     */

    protected $fillable = array('family_id',
                                'contact_id',
                                'primary',
                                'currently_active');
    
    protected $with = array('family', 'contact');
        
    public function contact()
    {
        return $this->hasOne('Contact', 'id', 'contact_id');
    }
    
    public function family()
    {
        return $this->hasOne('Family', 'id', 'family_id');
    }
}
