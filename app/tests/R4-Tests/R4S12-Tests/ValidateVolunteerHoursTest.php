<?php
 
class ValidateVolunteerHoursTest extends TestCase {
    
   protected $goodVolunteerHoursInfo;
   protected $badVolunteerHoursInfo;
   
   public function setUp()
   {
       parent::setUp();
       
       $this->goodVolunteerHoursInfo = array(
           0 => array(
            'id' => '1',
            'volunteer_id' => '3',
            'hours' => '3',
            'date_of_contribution' => '2015-04-14',
            'project_id' => '5',
            'paid_hours' => '',
            'family_id' => '5'
               ),
           1 => array (
            'id' => '2',               
            'volunteer_id' => '4',
            'hours' => '4',
            'date_of_contribution' => '2015-01-16',
            'project_id' => '5',
            'paid_hours' => '',
            'family_id' => '8'
               ),
           2 => array (
            'id' => '3',               
            'volunteer_id' => '12',
            'hours' => '9',
            'date_of_contribution' => '2015-02-15',
            'project_id' => '15',
            'paid_hours' => '',
            'family_id' => '7'
               )
           );
       $this->badVolunteerHoursInfo = array(
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
        $volunteerHoursValidator = new App\Libraries\Validators\VolunteerHourValidator($this->goodVolunteerHoursInfo);

        
        $this->assertTrue($volunteerHoursValidator->passes());
        print_r($volunteerHoursValidator->getErrors());        
        
        $this->assertNull($volunteerHoursValidator->getErrors());
    }
    public function testValidatorFailsAll()
    {
        $volunteerHoursValidator = new App\Libraries\Validators\VolunteerHourValidator($this->badVolunteerHoursInfo);
        
        $this->assertFalse($volunteerHoursValidator->passes());
    }
    public function testValidatorHasEightErrors()
    {
        $volunteerHoursValidator = new App\Libraries\Validators\VolunteerHourValidator($this->badVolunteerHoursInfo);
        
        $this->assertFalse($volunteerHoursValidator->passes());
        
        
        $this->assertEquals(count($volunteerHoursValidator->getErrors()), 8);
    }
    public function testValidatorErrorMessageExists()
    {
        $this->goodVolunteerHoursInfo[0]['hours'] = '0';
        
        $volunteerHoursValidator = new App\Libraries\Validators\VolunteerHourValidator($this->goodVolunteerHoursInfo);
        
        $this->assertFalse($volunteerHoursValidator->passes());

        
        $this->assertContains("hours", $volunteerHoursValidator->getErrors()->first('hours.1'));
    }
    public function testValidatorErrorMessageNotExists()
    {    
        $this->badVolunteerHoursInfo[1]['hours'] = '5';
        $volunteerHoursValidator = new App\Libraries\Validators\VolunteerHourValidator($this->badVolunteerHoursInfo);
        
        $this->assertFalse($volunteerHoursValidator->passes());
        
        $this->assertNotContains("hours", $volunteerHoursValidator->getErrors()->first('hours.1'));
    }
}