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
        'first_name' => 'required',
        'last_name' => 'required',
        'company' => '',
        'email_address' => 'required|email',
        'home_phone' => 'required|phone',
        'cell_phone' => 'phone|cellPhone',
        'work_phone' => 'phone|workPhone',
        'street_address' => 'required',
        'city' => 'required',
        'province' => 'required',
        'postal_code' => 'required|min:6|max:6',
        'country' => 'required',
        'comments' => '',
    );

}
