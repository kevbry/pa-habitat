<?php

class ProjectInspection extends \Eloquent
{
    /**
     * $table The database table used by the model.
     * $with The object used by the relation to this model
     * $fillable An array indicating the fields that are allowed to be 
     * mass-fillable.
     */
    protected $table = 'ProjectInspection';
    protected $with = array('project');
    
    protected $fillable = array('id', 'project_id', 'mandatory', 'date', 'type',
        'pass', 'comments');
    
    public function project()
    {
        return $this->hasOne('Project','id','project_id');
    }
    
}

