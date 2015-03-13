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
    
    public static $rules = array(
        'first_name' => '',
        'last_name' => '',
        'email_address' => 'required|email',
        'home_phone' => 'required|phone',
        'cell_phone' => '',
        'work_phone' => '',
        'street_address' => '',
        'city' => '',
        'province' => '',
        'postal_code' => 'required|min:6|max:6',
        'country' => '',
        'comments' => '',
    );

}
