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
    //This method replaces the terrible validation.phone error message with a beautiful informative one.
    protected function replacePhone($message, $attribute, $rule, $parameters)
    {
         return str_replace('validation.phone', 'Phone number should be in the format (###)-###-####', $message);
    }
 //*****************READ THIS*******************************//
    /*
     * IF YOU ARE PLANNING ON ADDING A CUSTOM VALIDATOR, YOU NEED THE RESOLVE METHOD THAT
     * IS ADDED AT THE BOTTOM OF START/GLOBAL.php FOR THE METHOD OF YOUR VALIDATION.
     */
}
