<?php
use Mockery as m;
use App\Libraries\validators\ProjectValidator;

class ValidateProjectTest extends TestCase {
    
   protected $goodProjectInfo;

   public function setUp()
   {
       parent::setUp();
       
       $this->goodProjectInfo = array(
        'build_number' => '45678',
        'name' => 'Project Name',
        'street_number' => '123 Fake Street',
        'postal_code' => 'S7M 3X1',
        'city' => 'Saskatoon',
        'province' => 'SK',
        'start_date' => '',
        'end_date' => ''
         );
   }
   public function testValidatorPassesAll()
    {
        $projectValidator = new App\Libraries\validators\ProjectValidator($this->goodProjectInfo);
        
        $this->assertTrue($projectValidator->passes());
    }
    
    public function testValidateBeforeDatePass()
    {
        $this->goodProjectInfo["start_date"] = "2015-01-20";
        $this->goodProjectInfo["end_date"] = "2015-02-20";
        $projectValidator = new App\Libraries\validators\ProjectValidator($this->goodProjectInfo);

        $this->assertTrue($projectValidator->passes());
    }
    
    public function testValidateBeforeDateFail()
    {
        $this->goodProjectInfo["start_date"] = "2015-04-09";
        $this->goodProjectInfo["end_date"] =  "2014-01-08";
        $projectValidator = new App\Libraries\validators\ProjectValidator($this->goodProjectInfo);

        $this->assertFalse($projectValidator->passes());
    }
}