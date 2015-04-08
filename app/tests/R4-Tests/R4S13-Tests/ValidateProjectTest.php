<?php
 
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
        'end_date' => '',
        'comments' => 'Comments',
        'building_permit_date' => '2015-01-25',
        'building_permit_number' => '3D4F6YRR',
        'mortgage_date' => '2015-02-25',
        'blueprint_plan_number' => '345TYRU89',
        'blueprint_designer' => 'Blueprint Barn');
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
        $this->goodProjectInfo["start_date"] = "yellow";
        $projectValidator = new App\Libraries\validators\ProjectValidator($this->goodProjectInfo);

        $this->assertFalse($projectValidator->passes());
    }
}