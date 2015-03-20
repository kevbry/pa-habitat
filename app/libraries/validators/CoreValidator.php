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
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
    //Validator Regex for work phone, ###-###-####
    public function validateWorkPhone($attribute, $value, $parameters)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
    //Validator Regex for cell phone, ###-###-####
    public function validateCellPhone($attribute, $value, $parameters)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
    //Validator Regex for postal codes LNL NLN or LNLNLN
    public function validatePostalCode($attribute, $value, $parameters)
    {
        return preg_match("^[A-Z][0-9][A-Z] ?[0-9][A-Z][0-9]$^", $value);
    }
    
    public function validateSafetyMeetingDate($attribute, $value, $parameters) 
    {
        $return_value = FALSE;
        
        $dt = new DateTime('Y-m-d');
        //$dt->format('YYYY-mm-dd');
        //$dt->ToString();
        if(strtotime($value) <= strtotime($dt))
        {
            $return_value = TRUE;
        }
        return $return_value;
    }
}
