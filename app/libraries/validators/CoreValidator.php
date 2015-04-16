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
     //Validator Regex for letters and spaces ex. Prince Albert
    public function validateAlphaSpace($attribute, $value, $parameters)
    {      
        return preg_match("/^[a-zA-Z]+(?:[.'\-,]?\s?[a-zA-Z]+)*$/",$value);       
    }
    //Validator Regex for letters, spaces and numbers ex. 123 Main Street
    public function validateAlphaSpaceNum($attribute, $value, $parameters)
    {
        return preg_match("^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$^",$value);
    }

    //Validator Regex for more complex addresses such as 45-a West Street, East
    public function validateAddress($attribute, $value, $parameters)
    {

        return preg_match("^\A((\w+|\d+)[a-zA-Z]{0,1}\s{0,1}[-]{1}\s{0,1}\d*[a-zA-Z]{0,1}|(\w+|\d+)[a-zA-Z-]{0,1}\d*[a-zA-Z]{0,1})\s*+(.*)$^",$value); 
        
        
    }

	/*
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
        if($value != null)
        {
            $inputDate = new DateTime($value);
            $inputDate->format('Y-m-d');
            
            //If todaysDate is greater than or equal to the inputDate, the date is valid
            if( $todaysDate >= $inputDate)
            {
                $return_value = TRUE;
            }
        }
 
        return $return_value;
    }

	/*
     * @param string $value
     * @param string $parameters
     * @return int
     */
    public function validateBeforeDate($attribute, $value, $parameters)
    {
        $otherValue =Input::get('end_date');
        

        $check = true;
        
       if( $otherValue )
        {
          //we compare with the provided value
          $check = ( strtotime( $value ) < strtotime( $otherValue ) );
        }
               
      return $check;       
    }
    

    
}
