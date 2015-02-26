<?php

/**
 * Description of EditProjectHoursTest
 *
 * @author cst217
 */
class EditProjectHoursTest extends TestCase 
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
        //$this->app->instance('app\controllers\VolunteerHoursController', $this->mockedVolunteerHoursController);
        
        $this->mockedVolunteerRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app\repositories\VolunteerRepository', $this->mockedVolunteerRepo);
        
        //$this->mockedProjectRepo = Mockery::mock('app\repositories\ProjectRepository');
        //$this->app->instance('app\repositories\ProjectRepository', $this->mockedProjectRepo);
        
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
            'volunteer_id' => 1, 
            'project_id' => 1, 
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
        $this->assertRedirectedToAction('VolunteerHoursController@indexForProject',1);
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
         $this->mockedVolunteerRepo
                ->shouldReceive('getAllVolunteersNonPaginated')->once();
        //$this->mockedProjectRepo
        //        ->shouldReceive('getAllProjectsNonPaginated')->once();
        //$this->mockedProjectRepo
        //        ->shouldReceive('getProject')->once()->with(1);
        $this->mockedFamilyRepo
                ->shouldReceive('getAllFamilies')->once();
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForProject')->once()->with(1);
        
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $this->call('GET','volunteerhours/edit/project/1');
        
        $this->assertResponseOk();
        
    }   
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
}
