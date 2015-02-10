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
    
    public function testIndexForProject()
    {
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForVolunteerSortedByProject')->once()->with(1);
        
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $this->call('GET','volunteerhours/report/1');
        $crawler = $this->client->request('GET', 'volunteerhours/report/1');
        
        $this->assertResponseOk();
        $this->assertCount(1, $crawler->filter('th:contains("Hours Volunteered")'));
    } 
    
}