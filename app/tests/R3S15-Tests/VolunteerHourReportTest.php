<?php
 
class VolunteerHourReportTest extends TestCase 
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
    
    public function testView()
    {
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForVolunteerSortedByProject')->once()->with(176);
        $this->mockedVolunteerRepo
                ->shouldReceive('getVolunteer')->once()->with(120);
        $this->mockedProjectRepo
                ->shouldReceive('getAllProjects')->once();
        $this->mockedFamilyRepo
                ->shouldReceive('getAllFamilies')->once();
        
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $response = $this->call('GET','volunteerhours/report/176');
       
        $this->assertResponseOk();
        $this->assertContains('Volunteer Hours for', $response->getContent());
    } 
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
}