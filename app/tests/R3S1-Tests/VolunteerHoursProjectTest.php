<?php
 
class VolunteerHoursProjectTest extends TestCase 
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
        
        $this->mockedProjectRepo = Mockery::mock('App\Repositories\EloquentProjectRepository');
        $this->app->instance('App\Repositories\ProjectRepository', $this->mockedProjectRepo);
        
        $this->mockedFamilyRepo = Mockery::mock('app\repositories\FamilyRepository');
        $this->app->instance('app\repositories\FamilyRepository', $this->mockedFamilyRepo);
    }
    
        
    /**
     * Test that the controller can sucessfully add hours to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->volunteerHoursInput = [
            'id' => '555',
            'volunteer_id' => 2, 
            'project_id' => 2, 
            'family_id' => 1,
            'date_of_contribution' => '2015-01-22',
            'paid_hours' => 1, 
            'hours' => 8
         ];
        // Assemble
        //$this->mockedVolunteerHoursController->shouldReceive('storeHoursEntryWith')->once()->with($this->volunteerHoursInput);
        $this->mockedVolunteerHoursRepo->shouldReceive('saveVolunteerHours')->once()->with(Mockery::type('VolunteerHours'));

        // Act 
        $response = $this->route("POST", "storehours", $this->volunteerHoursInput);

        // Assert
        $this->assertRedirectedToAction('VolunteerHoursController@indexForProject',2);
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
    
    public function testIndexForProject()
    {
        $TestController = new VolunteerHoursController($this->mockedVolunteerRepo, $this->mockedProjectRepo,
                $this->mockedVolunteerHoursRepo, $this->mockedFamilyRepo);
        $this->mockedVolunteerRepo
                ->shouldReceive('getAllVolunteers')->once();
        $this->mockedProjectRepo
                ->shouldReceive('getProject')->once()->with(2)
                ->passthru();
        $this->mockedFamilyRepo
                ->shouldReceive('getAllFamilies')->once();
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForProject')->once()->with(2);
        
        //$this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $response = $this->call('GET','/volunteerhours/project/2');
        //$response = $TestController->indexForProject(2);
        //$response = $this->route("GET", "projHoursRoute",2);
        //$this->assertTrue($response->getContent());
        $this->assertContains("Volunteer Hours for",$response->getContent());
        
    } 
    

    /*
     * Test clean up
     */
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }     
    
}


