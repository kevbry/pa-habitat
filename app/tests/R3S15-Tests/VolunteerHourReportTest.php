<?php
 
class VolunteerHourReportTest extends TestCase 
{
    protected $mockedVolunteerHoursRepo;
    protected $mockedVolunteerHoursController;
    protected $volunteerHoursInput;
    
    protected $invalidDataException;
    
    public function setUp()
    {
        parent::setUp();
        //TODO - Populate array with a dummy entry for the volunteerhours table
        $this->volunteerHoursInput = [];

        // Set up the Volunteer Hours Mocked Repository
        $this->mockedVolunteerHoursRepo = Mockery::mock('app\repositories\VolunteerHoursRepository');
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $this->mockedVolunteerHoursController = Mockery::mock('app\controllers\VolunteerHoursController');
        $this->app->instance('app\controllers\VolunteerHoursController', $this->mockedVolunteerHoursController);
    }
    
    public function testView()
    {
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForVolunteerSortedByProject')->once()->with(176);
        
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $response = $this->call('GET','volunteerhours/report/176');
       
        $this->assertResponseOk();
        $this->assertContains('Volunteer Hours for', $response->getContent());
    } 
    public function tearDown()
    {
        parent::tearDown();
    }
}