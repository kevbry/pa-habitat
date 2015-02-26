<?php
 
class EditVolunteerHoursTest extends TestCase 
{
    protected $mockedVolunteerHoursRepo;
    protected $mockedVolunteerHoursController;
    protected $volunteerHoursInput;
    protected $mockedFamilyRepo;
    protected $mockedVolunteerRepo;
    protected $mockedProjectRepo;
    
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
        
        $this->mockedVolunteerRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app\repositories\VolunteerRepository', $this->mockedVolunteerRepo);
        
        $this->mockedProjectRepo = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->mockedProjectRepo);
        
        $this->mockedFamilyRepo = Mockery::mock('app\repositories\FamilyRepository');
        $this->app->instance('app\repositories\FamilyRepository', $this->mockedFamilyRepo);
    }    
        
    /**
     * Test that the controller can successfully edit hours in the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForVolunteerNonPaginated')->once()->with(2)->passthru();
        
        $this->volunteerHoursInput = [
            'id' => '603',
            'volunteer_id[]' => 2, 
            'project_id[]' => 2, 
            'family_id[]' => 2,
            'date_of_contribution[]' => '2015-05-04',
            'paid_hours[]' => 1, 
            'hours[]' => 5,
            'vol_id' => 2
         ];
        // Assemble
        //$this->mockedVolunteerHoursController->shouldReceive('storeHoursEntryWith')->once()->with($this->volunteerHoursInput);
        $this->mockedVolunteerHoursRepo->shouldReceive('saveVolunteerHours')->once()->with(Mockery::type('VolunteerHours'));

        // Act 
        $response = $this->route("POST", "updatehours", $this->volunteerHoursInput);

        // Assert
        $this->assertRedirectedToAction('VolunteerHoursController@indexForContact',2);
    }
    
    public function OFF_testStoreSingleEntryFailure()
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
        $this->mockedVolunteerRepo
                ->shouldReceive('getVolunteer')->once()->with(2);
        $this->mockedProjectRepo
                ->shouldReceive('getAllProjectsNonPaginated')->once();
        $this->mockedFamilyRepo
                ->shouldReceive('getAllFamiliesNonPaginated')->once();
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForVolunteer')->once()->with(2);
        
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $this->call('GET','volunteerhours/volunteer/2');
        
        $this->assertResponseOk();
    }
    
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
    

    
}


