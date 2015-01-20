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
        
    public function family()
    {
        return $this->belongsToMany('Family', 'FamilyContact', 'family_id', 'contact_id')
                ->withPivot('primary', 'currently_active');
    }
}

