<?php
 
class ProjectHourReportTest extends TestCase 
{
    protected $mockedVolunteerHoursRepo;
    protected $mockedVolunteerRepo;
    protected $mockedFamilyRepo;
    protected $mockedProjectRepo;
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
        /*
        $this->mockedVolunteerHoursController = Mockery::mock('app\controllers\VolunteerHoursController');
        $this->app->instance('app\controllers\VolunteerHoursController', $this->mockedVolunteerHoursController);
        */
        $this->mockedVolunteerRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app\repositories\VolunteerRepository', $this->mockedVolunteerRepo);
        /*
        $this->mockedProjectRepo = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->mockedProjectRepo);
        */
        $this->mockedFamilyRepo = Mockery::mock('app\repositories\FamilyRepository');
        $this->app->instance('app\repositories\FamilyRepository', $this->mockedFamilyRepo);
    }
    
    public function testView()
    {   //$this->mockedProjectRepo
         //       ->shouldReceive('getProject')->once()->with(1);
        $this->mockedVolunteerRepo
                ->shouldReceive('getAllVolunteers')->once();
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForProjectSortedByVolunteer')->once()->with(1);
        $this->mockedFamilyRepo
                ->shouldReceive('getAllFamiliesNonPaginated')->once();
        
        //$this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        //$response = $this->call('GET','projecthours/report/176');
        $response = $this->action('GET', 'VolunteerHoursController@viewHoursReportForProject', array(1));
       
        $this->assertResponseOk();
        $this->assertContains('Project Hours for', $response->getContent());
    } 
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
}