<?php
 
use Mockery as m;
use App\Libraries\validators\ContactValidator;
 
//This will create a volunteer and fill out every field, including the last 
//attended safety meeting date. The tests are then run on everything.
class ValidateVolunteerTest extends TestCase {

    protected $goodContactInfo;

    public function setUp()
    {
        parent::setUp();

        $this->goodContactInfo = array(
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
             'comments' => '',
             'last_attended_safety_meeting_date' => '2015-03-22'
            );
    }
    public function testValidatorPassesAll()
     {
         $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

         $this->assertTrue($contactValidator->passes());
     }
     public function testValidatePhonePass()
    {
        $this->goodContactInfo["home_phone"] = "306-999-9999";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertTrue($contactValidator->passes());
    }
    public function testValidatePhoneFail()
    {
        $this->goodContactInfo["home_phone"] = "GHOUL";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertFalse($contactValidator->passes());
    }
    
    public function testValidateWorkPhonePass()
    {
        $this->goodContactInfo["work_phone"] = "306-999-9999";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertTrue($contactValidator->passes());
    }
    public function testValidateWorkPhoneFail()
    {
        $this->goodContactInfo["work_phone"] = "GHOST";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertFalse($contactValidator->passes());
    }
    
    public function testValidateCellPhonePass()
    {
        $this->goodContactInfo["cell_phone"] = "306-999-9999";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertTrue($contactValidator->passes());
    }
    public function testValidateCellPhoneFail()
    {
        $this->goodContactInfo["cell_phone"] = "GHASTLY";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertFalse($contactValidator->passes());
    }
    
    public function testValidatePostalCodePass()
    {
        $this->goodContactInfo["postal_code"] = "s0k 0z0";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertTrue($contactValidator->passes());
    }
    public function testValidatePostalCodeFail()
    {
        $this->goodContactInfo["postal_code"] = "GRIMEE";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertFalse($contactValidator->passes());
    }
    
    public function testValidateAlphaSpacePass()
    {
        $this->goodContactInfo["province"] = "New Brunswick";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertTrue($contactValidator->passes());
    }
    public function testValidateAlphaSpaceFail()
    {
        $this->goodContactInfo["province"] = "%@.com";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertFalse($contactValidator->passes());
    }
    
    public function testValidateAddressPass()
    {
        $this->goodContactInfo["street_address"] = "123 Main Street, East";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertTrue($contactValidator->passes());
    }
    public function testValidateAddressFail()
    {
        $this->goodContactInfo["street_address"] = "HAPPY BIRTHDAY!";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertFalse($contactValidator->passes());
    }
    
    public function testValidateSafetyMeetingDatePass()
    {
        $this->goodContactInfo["last_attended_safety_meeting_date"] = "2015-03-22";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertTrue($contactValidator->passes());
    }
    
    public function testValidateSafetyMeetingDateFail()
    {
        $this->goodContactInfo["last_attended_safety_meeting_date"] = "2115-03-22";
        $contactValidator = new App\Libraries\validators\ContactValidator($this->goodContactInfo);

        $this->assertFalse($contactValidator->passes());
    }
}    