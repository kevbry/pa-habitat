<?php
 
class VolunteerHoursTest extends TestCase 
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
        
    /**
     * Test that the controller can sucessfully add hours to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->volunteerHoursInput = [
            'volunteer_id[]' => 118, 
            'project_id[]' => 118, 
            'family_id[]' => 1,
            'date_of_contribution[]' => '2015-01-22',
            'paid_hours[]' => 1, 
            'hours[]' => 8,
            'pageType' => 'volunteer'
         ];
        // Assemble
        $this->mockedVolunteerHoursController->shouldReceive('storeHoursEntryWith')->once()->with($this->volunteerHoursInput);
        $this->mockedVolunteerHoursRepo->shouldReceive('saveVolunteerHours')->once()->with(Mockery::type('VolunteerHours'));

        // Act 
        $response = $this->route("POST", "storehours", $this->volunteerHoursInput);

        // Assert
        $this->assertRedirectedToAction('VolunteerHoursController@indexForContact',118);
    }
    
    public function testStoreSingleEntryFailure()
    {
        $this->volunteerHoursInput = [];
        
        // Assemble
        $this->mockedVolunteerHoursController
                ->shouldReceive('storeHoursWith')
                ->once()
                ->with($this->volunteerHoursInput)
                ->andThrow(new Exception());
    }

     public function testIndexForVolunteer()
    {
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForVolunteer')->once()->with(118);
        
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $this->call('GET','volunteerhours/volunteer/118');
        
        $this->assertResponseOk();
    }
    
    public function tearDown()
    {
        parent::tearDown();
    }
}