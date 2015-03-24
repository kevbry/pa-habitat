<?php
/**
 * Description of CoreValidator
 *
 * @author cst224
 */
class CoreValidator extends Illuminate\Validation\Validator {
    
    protected $implicitRules = array('Required', 'RequiredWith', 'RequiredWithout', 'RequiredIf', 'Accepted', 'RequiredWithoutField');

    public function __construct(\Symfony\Component\Translation\TranslatorInterface $translator, $data, $rules, $messages = array())
    {
        parent::__construct($translator, $data, $rules, $messages);
        $this->isImplicit('fail');
    }
    //Custom error messages are added here
    //Be sure to add an error message to app/lang/en/validation.php when adding any new custom validation
    
    //Validator Regex for home phone, ###-###-####
    public function validatePhone($attribute, $value, $parameters)
    {
        return preg_match("^([0-9]{0,3})[-. ]?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})\$^", $value);
    }
    //Validator Regex for work phone, ###-###-####
    public function validateWorkPhone($attribute, $value, $parameters)
    {
        return preg_match("^([0-9]{0,3})[-. ]?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})\$^", $value);
    }
    //Validator Regex for cell phone, ###-###-####
    public function validateCellPhone($attribute, $value, $parameters)
    {
        return preg_match("^([0-9]{0,3})[-. ]?\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})\$^", $value);
    }
    //Validator Regex for postal codes LNL NLN or LNLNLN
    public function validatePostalCode($attribute, $value, $parameters)
    {
        return preg_match("^[a-zA-Z][0-9][a-zA-Z] ?[0-9][a-zA-Z][0-9]$^", $value);
    }

       /**
     * Validator to ensure the inputted date is not in the future
     * 
     * @param string $attribute
     * @param date $value
     * @param string $parameters
     * @return boolean
     */
    public function validateSafetyMeetingDate($attribute, $value, $parameters) 
    {
        //Set the return value
        $return_value = FALSE;
        
        //create today's date
        $todaysDate = new DateTime();
        $todaysDate->format('Y-m-d');
      
        //The inputted date
        $inputDate = new DateTime($value);
        $inputDate->format('Y-m-d');
        
        //If todaysDate is greather than or equal to the inputDate, the date is valid
        if( $todaysDate >= $inputDate )
        {
            $return_value = TRUE;
        }
        return $return_value;
    }
}
