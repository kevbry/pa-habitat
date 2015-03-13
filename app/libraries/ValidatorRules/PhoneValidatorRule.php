<?php

/**
 * Description of PhoneValidationRule
 * Custom validator for phone numbers.
 * @author cst224
 */
class PhoneValidatorRule extends \Illuminate\Validation\Validator {
    //Create the custom validation, this is a regex for phone.
    public function validatePhone($attribute, $value, $parameters)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
 //*****************READ THIS*******************************//
    /*
     * IF YOU ARE PLANNING ON ADDING A CUSTOM VALIDATOR, YOU NEED THE RESOLVE METHOD THAT
     * IS ADDED AT THE BOTTOM OF START/GLOBAL.php FOR THE METHOD OF YOUR VALIDATION.
     */
}
