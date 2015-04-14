<?php namespace App\Libraries\Validators;

/**
 * Description of company
 *
 *
 */
class CompanyValidator extends Validator {
    //an array of the validators to be used on the fields
    public static $rules = array(
        'name' => 'required',
        'primary_contact_1' => 'required'
    );
}
