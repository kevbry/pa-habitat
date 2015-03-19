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
        return preg_match("^[a-zA-Z][0-9][a-zA-Z] ?[0-9][a-zA-Z][0-9]$^", $value);
    }
    //Validator Regex for letters and spaces ex. Prince Albert
    public function validateAlphaSpace($attribute, $value, $paramteres)
    {
        return preg_match("/^[a-zA-Z\s]*$/",$value);
    }
    //Validator Regex for letters, spaces and numbers ex. 123 Main Street
    public function validateAlphaSpaceNum($attribute, $value, $paramteres)
    {
        return preg_match("^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$^",$value);
    }
    
}
