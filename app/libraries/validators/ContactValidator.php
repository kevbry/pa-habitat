<?php namespace App\Libraries\Validators;

/**
 * Description of Contact
 *
 * @author cst224
 */
class ContactValidator extends Validator {
    //an array of the validators to be used on the fields
    public static $rules = array(
        'first_name' => 'required|alpha',
        'last_name' => 'required|alpha',
        'company' => '',
        'email_address' => 'required|email',
        'home_phone' => 'required|phone',
        'cell_phone' => 'phone|cellPhone',
        'work_phone' => 'phone|workPhone',
        'street_address' => 'required|address|min:5',
        'city' => 'required|alphaspace',
        'province' => 'required|alphaspace',
        'postal_code' => 'required|postalcode',
        'country' => 'required|alphaspace',
        'comments' => '',
    );

}
