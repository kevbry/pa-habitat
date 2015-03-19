<?php namespace App\Libraries\Validators;

/**
 * Description of Contact
 *
 * @author cst224
 */
class ContactValidator extends Validator {
    //an array of the validators to be used on the fields
    public static $rules = array(
        'first_name' => 'required|alphaDash',
        'last_name' => 'required|alphaDash',
        'company' => '',
        'email_address' => 'required|email',
        'home_phone' => 'required|phone',
        'cell_phone' => 'phone|cellPhone',
        'work_phone' => 'phone|workPhone',
        'street_address' => 'required|alphaspacenum',
        'city' => 'required|alphaspace',
        'province' => 'required|alphaspace',
        'postal_code' => 'required|postalcode',
        'country' => 'required|alphaspace',
        'comments' => '',
    );

}
