<?php
 
use Mockery as m;
use App\Libraries\Validators\CompanyValidator;
 
//This will create a volunteer and fill out every field, including the last 
//attended safety meeting date. The tests are then run on everything.
class ValidateCompanyTest extends TestCase {

    protected $goodCompanyInfo;

    public function setUp()
    {
        parent::setUp();

        $this->goodCompanyInfo = array(
             'name' => 'Yen Company',
             'primary_contact_1' => '1',
            );
    }
    public function testValidatorPassesAll()
     {
         $companyValidator = new App\Libraries\Validators\CompanyValidator($this->goodCompanyInfo);

         $this->assertTrue($companyValidator->passes());
     }
     public function testValidateNamePass()
    {
        $this->goodCompanyInfo["name"] = "name";
        $companyValidator = new App\Libraries\Validators\CompanyValidator($this->goodCompanyInfo);

        $this->assertTrue($companyValidator->passes());
    }
    public function testValidateNameFail()
    {
        $this->goodCompanyInfo["name"] = "";
        $companyValidator = new App\Libraries\Validators\CompanyValidator($this->goodCompanyInfo);

        $this->assertFalse($companyValidator->passes());
    }
    
    public function testValidatePrimaryContact1Pass()
    {
        $this->goodCompanyInfo["primary_contact_1"] = "1";
        $companyValidator = new App\Libraries\Validators\CompanyValidator($this->goodCompanyInfo);

        $this->assertTrue($companyValidator->passes());
    }
    public function testValidatePrimaryContact1Fail()
    {
        $this->goodCompanyInfo["primary_contact_1"] = "";
        $companyValidator = new App\Libraries\Validators\CompanyValidator($this->goodCompanyInfo);

        $this->assertFalse($companyValidator->passes());
    }
}    