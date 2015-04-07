<?php
 
class ValidateProjectTest extends TestCase {
    
   protected $goodProjectInfo;

   public function setUp()
   {
       parent::setUp();
       
       $this->goodProjectInfo = array(
        'start_date' => '',
        'end_date' => '');
   }
   public function testValidatorPassesAll()
    {
        $projectValidator = new App\Libraries\validators\ProjectValidator($this->goodProjectInfo);

        $this->assertTrue($projectValidator->passes());
    }
    
    public function testValidateBeforeDatePass()
    {
        $this->goodProjectInfo['start_date'] = "2015-01-20";
        $projectValidator = new App\Libraries\validators\ProjectValidator($this->goodProjectInfo);

        $this->assertTrue($projectValidator->passes());
    }
    
    public function testValidateBeforeDateFail()
    {
        $this->goodProjectInfo['start_date'] = "yellow";
        $projectValidator = new App\Libraries\validators\ProjectValidator($this->goodProjectInfo);

        $this->assertFalse($projectValidator->passes());
    }
}