<?php namespace App\Libraries\validators;

/**
 * Description of Project
 *
 * @author cst224
 */
class ProjectEditValidator extends Validator {
    //an array of the validators to be used on the fields
    
    
    public static $rules = array(
        'build_number' => 'required|alpha_num',
        'street_number' => 'required|address',
        'postal_code' => 'required|postalcode',
        'city' => 'required|alphaspace',
        'province' => 'required|alphaspace',
        'start_date' => 'beforedate',
        'end_date' => '',
        'comments' => '',
        'building_permit_date' => '',
        'building_permit_number' => 'alpha_num',
        'mortgage_date' => '',
        'blueprint_plan_number' => 'alpha_num',
        'blueprint_designer' => 'alpha_num',
    );

}
