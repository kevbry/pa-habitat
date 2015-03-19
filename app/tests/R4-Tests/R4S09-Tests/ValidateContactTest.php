<?php
 
class ValidateContactTest extends TestCase {
    
    protected $contactInfo;
    
   public function testValidatorPasses()
    {
        $contactInfo = array(
            'first_name' => 'John',
            'last_name' => 'Doe',
            'company' => 'Company',
            'email_address' => 'email@email.com',
            'home_phone' => '306-999-9999',
            'cell_phone' => '',
            'work_phone' => '',
            'street_address' => '123 fake street',
            'city' => 'saskatoon',
            'province' => 'SK',
            'postal_code' => 's0k 0z0',
            'country' => 'canada',
            'comments' => '');
        
        $contactValidator = new App\Libraries\Validators\ContactValidator($contactInfo);

        $this->assertTrue($contactValidator->passes());
    }
    public function testValidatorFailsNoInput()
    {
        $contactInfo = array(
            'first_name' => '',
            'last_name' => '',
            'company' => '',
            'email_address' => '',
            'home_phone' => '',
            'cell_phone' => '',
            'work_phone' => '',
            'street_address' => '',
            'city' => '',
            'province' => '',
            'postal_code' => '',
            'country' => '',
            'comments' => '');
        
        $contactValidator = new App\Libraries\Validators\ContactValidator($contactInfo);

        $this->assertFalse($contactValidator->passes());
    }
    public function testValidatorFailsBadInput()
    {
        $contactInfo = array(
            'first_name' => '45',
            'last_name' => '76',
            'company' => '?l',
            'email_address' => '$$$@awesome.co$',
            'home_phone' => '$$$',
            'cell_phone' => '',
            'work_phone' => '',
            'street_address' => '$$$$',
            'city' => '$$$$',
            'province' => '$$$',
            'postal_code' => '@#',
            'country' => '%$%^',
            'comments' => '');
        
        $contactValidator = new App\Libraries\Validators\ContactValidator($contactInfo);

        $this->assertFalse($contactValidator->passes());
    }
}