<?php

class WorkPhoneValidatorRule extends \Illuminate\Validation\Validator {
    //Create the custom validation, this is a regex for phone.
    public function validateWorkPhone($attribute, $value, $parameters)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
    //This method replaces the terrible validation.phone error message with a beautiful informative one.
    //You should probably mention the field names in lowercase, because this is how we use assoc arrays
    //to actually display the messages. It might break if you use upper case.
    protected function replaceWorkPhone($message, $attribute, $rule, $parameters, $phone='')
    {
         return str_replace('validation.WorkPhone', 'The work phone field should be in the format ###-###-####', $message);
    }
 //*****************READ THIS*******************************//
    /*
     * IF YOU ARE PLANNING ON ADDING A CUSTOM VALIDATOR, YOU NEED THE RESOLVE METHOD THAT
     * IS ADDED AT THE BOTTOM OF START/GLOBAL.php FOR THE METHOD OF YOUR VALIDATION.
     */
}
Validator::extend('workphone', 'WorkPhoneValidatorRule@validateWorkPhone');