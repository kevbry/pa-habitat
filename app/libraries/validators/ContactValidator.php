<?php namespace App\Libraries\Validators;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
        'street_address' => 'required|alpha_num',
        'city' => 'required|alpha',
        'province' => 'required|alpha',
        'postal_code' => 'required|postalcode',
        'country' => 'required|alpha',
        'comments' => '',
    );

}
