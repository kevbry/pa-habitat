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
    //Be sure to add an error message to app/lang/en/validation.php when adding any new custom validation
    public function validatePhone($attribute, $value, $parameters, $validator)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
    public function validateWorkPhone($attribute, $value, $parameters, $validator)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
    public function validateCellPhone($attribute, $value, $parameters, $validator)
    {
        return preg_match("^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$^", $value);
    }
}
