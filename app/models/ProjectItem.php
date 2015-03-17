<?php

class ProjectItem extends \Eloquent
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ProjectItem';
    protected $with = array('project');
    public static $types = array(
                        'Cabinets',
                        'Countertop',
                        'Doors',
                        'Dryer',
                        'Flooring',
                        'Furnace',
                        'Heat Recovery Ventilation (HRV)',
                        'Pressure Tank',
                        'Refrigerator',
                        'Shingles',
                        'Siding',
                        'Smoke / CO Detector',
                        'Stove',
                        'Sump Pump',
                        'Tap',
                        'Toilet',
                        'Washer',
                        'Water Heater',
                        'Window Coverings',
                        'Windows');

    /**
     * The attributes that are mass-assignment
     *
     * @fillable array with column names we wish to be able to assign to.
     */
    protected $fillable = array('id', 'description', 'description', 'manufacturer', 'model', 'serial_number', 'vendor', 'comments');
    
    public function project()
    {
        return $this->hasOne('Project','id','project_id');
    }
    
}
