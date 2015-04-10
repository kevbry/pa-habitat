<?php namespace App\Libraries\validators;

/**
 * Description of Project
 *
 * @author cst224
 */
class ProjectValidator extends Validator {
    //an array of the validators to be used on the fields
    
    
    public static $rules = array(
        'build_number' => 'required|alpha_num',
        'name' => 'required',
        'street_number' => 'required|address',
        'postal_code' => 'postalcode',
        'city' => 'required|alphaspace',
        'province' => 'required|alphaspace',
        'start_date' => 'before:end_date',
        'end_date' => '',
        'comments' => '',
        'building_permit_date' => '',
        'building_permit_number' => 'alpha_num',
        'mortgage_date' => '',
        'blueprint_plan_number' => 'alpha_num',
        'blueprint_designer' => 'alpha_num',
    );

}
