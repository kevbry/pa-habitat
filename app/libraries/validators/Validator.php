<?php namespace App\Libraries\validators;

/**
 * Description of Validator
 * Abstract validation class that will be extended by other validation classes
 * @author cst224
 */
abstract class Validator {
    protected $input;
    
    protected $errors;
    //Constructor for the validator
    public function __construct($input = NULL)
    {
        //Either validate the optional info, or all inputs.
        $this->input = $input ?: \Input::all();
    }
    /**
     * 
     * @return boolean - Whether or not it passed the validation
     * Sets the error variable to be shown on the return screen.
     */
    public function passes()
    {
        $validation = \Validator::make($this->input,static::$rules);
        
        if($validation->passes()) return true;
        
        $this->errors = $validation->messages();
        
        return false;
    }
    /**
     * Simply returns the errors property
     * @return type
     */
    public function getErrors()
    {
        return $this->errors;
    }

}
