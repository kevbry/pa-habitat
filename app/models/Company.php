<?php
class Company extends \Eloquent
{
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'Company';  
    
    /**
    * The attributes that are mass-assignment
    *
    * @fillable array with column names we wish to be able to assign to.
    */
    protected $fillable = array('company_name','contact_id');
    
    
    public function mainContact()
    {
        return $this->belongsTo('Contact','contact_id','id');
    }
}