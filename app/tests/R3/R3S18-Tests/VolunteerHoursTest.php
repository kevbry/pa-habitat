<?php
 
class VolunteerHoursTest extends TestCase 
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
        
        //$this->mockedVolunteerHoursController = Mockery::mock('app\controllers\VolunteerHoursController');
        //$this->app->instance('App\Controllers\VolunteerHoursController', $this->mockedVolunteerHoursController);
        
        $this->mockedVolunteerRepo = Mockery::mock('App\Repositories\EloquentVolunteerRepository');
        $this->app->instance('App\Repositories\VolunteerRepository', $this->mockedVolunteerRepo);
        
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
            'volunteer_id[]' => 2, 
            'project_id[]' => 2, 
            'family_id[]' => 1,
            'date_of_contribution[]' => '2015-01-22',
            'paid_hours[]' => 1, 
            'hours[]' => 8,
            'pageType' => 'volunteer'
         ];
        // Assemble
        //$this->mockedVolunteerHoursController->shouldReceive('storeHoursEntryWith')->once()->with($this->volunteerHoursInput);
        $this->mockedVolunteerHoursRepo->shouldReceive('saveVolunteerHours')->once()->with(Mockery::type('VolunteerHours'));

        // Act 
        $this->route("POST", "storehours", $this->volunteerHoursInput);

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
                ->shouldReceive('getVolunteer')->once()->with(2)->passthru();
        $this->mockedProjectRepo
                ->shouldReceive('getAllProjects')->once()->passthru();
        $this->mockedFamilyRepo
                ->shouldReceive('getAllFamiliesNonPaginated')->once();
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForVolunteer')->once()->with(2);

        $this->call('GET','volunteerhours/volunteer/2');
        
        $this->assertResponseOk();
    }
    
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
}