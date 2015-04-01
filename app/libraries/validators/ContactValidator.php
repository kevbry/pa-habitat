<?php namespace App\Libraries\validators;

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
        'email_address' => 'email',
        'home_phone' => 'phone',
        'cell_phone' => 'phone|cellPhone',
        'work_phone' => 'phone|workPhone',
        'street_address' => 'address|min:5',
        'city' => 'alphaspace',
        'province' => 'alphaspace',
        'postal_code' => 'postalcode',
        'country' => 'alphaspace',
        'comments' => '',
        'last_attended_safety_meeting_date' => 'safetymeetingdate'
    );

}
