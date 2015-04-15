<?php
 
class ValidateProjectHoursTest extends TestCase {
    
   protected $goodProjectHoursInfo;
   protected $badProjectHoursInfo;
   
   public function setUp()
   {
       parent::setUp();
       
       $this->goodProjectHoursInfo = array(
           0 => array(
            'id' => '',
            'volunteer_id' => '2',
            'hours' => '3',
            'date_of_contribution' => '2015-04-14',
            'project_id' => '5',
            'paid_hours' => '',
            'family_id' => '5'
               ),
           1 => array (
            'id' => '',
            'volunteer_id' => '2',
            'hours' => '4',
            'date_of_contribution' => '2015-01-16',
            'project_id' => '5',
            'paid_hours' => '',
            'family_id' => '8'
               ),
           2 => array (
            'id' => '',
            'volunteer_id' => '2',
            'hours' => '9',
            'date_of_contribution' => '2015-02-15',
            'project_id' => '15',
            'paid_hours' => '',
            'family_id' => '7'
               )
           );
       $this->badProjectHoursInfo = array(
           0 => array(
            'id' => '1',
            'volunteer_id' => '',
            'hours' => '5',
            'date_of_contribution' => '2014-04-15',
            'project_id' => '5',
            'paid_hours' => '',
            'family_id' => '5'
               ),
           1 => array (
            'id' => '2',
            'volunteer_id' => '',
            'hours' => '',
            'date_of_contribution' => '',
            'project_id' => '',
            'paid_hours' => '',
            'family_id' => ''
               ),
           2 => array (
            'id' => '3',
            'volunteer_id' => '',
            'hours' => '7',
            'date_of_contribution' => '2015-05-15',
            'project_id' => '',
            'paid_hours' => '',
            'family_id' => ''
               )
       );
   }
   public function testValidatorPassesAll()
    {
        $volunteerHoursValidator = new App\Libraries\Validators\ProjectHourValidator($this->goodProjectHoursInfo);

        $this->assertTrue($volunteerHoursValidator->passes());
        $this->assertNull($volunteerHoursValidator->getErrors());
    }
    public function testValidatorFailsAll()
    {
        $volunteerHoursValidator = new App\Libraries\Validators\ProjectHourValidator($this->badProjectHoursInfo);
        
        $this->assertFalse($volunteerHoursValidator->passes());
    }
    public function testValidatorHasFiveErrors()
    {
        $volunteerHoursValidator = new App\Libraries\Validators\ProjectHourValidator($this->badProjectHoursInfo);
        
        $this->assertFalse($volunteerHoursValidator->passes());
        $this->assertEquals(count($volunteerHoursValidator->getErrors()), 5);
    }
    public function testValidatorErrorMessageExists()
    {
        $this->goodProjectHoursInfo[0]['hours'] = '0';
                
        $volunteerHoursValidator = new App\Libraries\Validators\ProjectHourValidator($this->goodProjectHoursInfo);
        
        $this->assertFalse($volunteerHoursValidator->passes());

        $this->assertContains("hours", $volunteerHoursValidator->getErrors()->first('hours.0'));
    }
    public function testValidatorErrorMessageNotExists()
    {    
        $this->badProjectHoursInfo[1]['hours'] = '5';
        $volunteerHoursValidator = new App\Libraries\Validators\ProjectHourValidator($this->badProjectHoursInfo);
        
        $this->assertFalse($volunteerHoursValidator->passes());
        
        $this->assertNotContains("hours", $volunteerHoursValidator->getErrors()->first('hours.1'));
    }
}