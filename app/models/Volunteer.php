<?php

class Volunteer extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Volunteer';
    protected $with = array('availability','certifications','trades','skills','interests');
    
    /**
     * The attributes that are mass-assignment
     *
     * @fillable array with column names we wish to be able to assign to.
     */
    protected $fillable = array('id', 'active_status', 'last_attended_safety_meeting_date');
    
    public function contact()
    {
        return $this->belongsTo('Contact','id', 'id');
    }
    
    public function availability()
    {
        return $this->hasMany('Availability', 'volunteer_id');
    }
    
    public function certifications()
    {
        return $this->belongsToMany('Certification', 'VolunteerCertification', 'volunteer_id', 'certification_id')
                ->withPivot('cert_earned_date', 'cert_expiry_date','comment');
    }
    
    public function trades()
    {
        return $this->belongsToMany('Trade','VolunteerTrades','volunteer_id','trade_id')
                ->withPivot('comments');
    }
    
    public function skills()
    {
        return $this->belongsToMany('Skill','VolunteerSkill','volunteer_id','skill_id')
                ->withPivot('comments','yearsExperience');
    }
    
    public function interests()
    {
        return $this->belongsToMany('Interest','VolunteerInterest','volunteer_id','interest_id')
                ->withPivot('comments');
    }
}
