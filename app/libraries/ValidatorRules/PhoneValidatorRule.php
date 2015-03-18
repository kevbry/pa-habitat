<?php

/**
 * Description of PhoneValidationRule
 * Custom validator for phone numbers.
 * @author cst224
 */
//IF YOU ARE CREATING CUSTOM VALIDATORS, MAKE SURE TO ADD A METHOD SIMILAR TO EXISTING
//METHODS IN THE BOTTOM OF THE APP/START/GLOBAL.PHP FILE, ELSE IT WILL THINK IT DOESN"T EXIST
class PhoneValidatorRule extends \Illuminate\Validation\Validator {
        
    function __construct(\Validator $validator)
    {
        $this->validator = $validator;
    }
    //Create the custom validation, this is a regex for phone.
    public function validatePhone($attribute, $value, $parameters, $validator)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
    //This method replaces the terrible validation.phone error message with a beautiful informative one.
    //You should probably mention the field names in lowercase, because this is how we use assoc arrays
    //to actually display the messages. It might break if you use upper case.
    protected function replacePhone($message, $attribute, $rule, $parameters, $phone='')
    {
         return str_replace('validation.phone', 'The home phone field should be in the format ###-###-####', $message);
    }
}
Validator::extend('phone_rule', 'PhoneValidatorRule@validatePhone');