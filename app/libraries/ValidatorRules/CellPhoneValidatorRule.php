<?php

 //*****************READ THIS*******************************//
    /*
     * IF YOU ARE PLANNING ON ADDING A CUSTOM VALIDATOR, YOU NEED THE RESOLVE METHOD THAT
     * IS ADDED AT THE BOTTOM OF START/GLOBAL.php FOR THE METHOD OF YOUR VALIDATION.
*/
class CellPhoneValidatorRule extends \Illuminate\Validation\Validator {
    
    function __construct(\Validator $validator)
    {
        $this->validator = $validator;
    }
    //Create the custom validation, this is a regex for phone.
    public function validateCellPhone($attribute, $value, $parameters, $validator)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
    //This method replaces the terrible validation.phone error message with a beautiful informative one.
    //You should probably mention the field names in lowercase, because this is how we use assoc arrays
    //to actually display the messages. It might break if you use upper case.
    protected function replaceCellPhone($message, $attribute, $rule, $parameters)
    {
         return str_replace('validation.cellPhone', 'The cell phone field should be in the format ###-###-####', $message);
    }
}