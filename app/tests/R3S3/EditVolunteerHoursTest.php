<?php
 
class EditVolunteerHoursTest extends TestCase 
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
     * Test that the controller creates and displays the view for adding hours
     */
//    public function testCreate()
//    {
//        $response = $this->action('GET', 'VolunteerHoursController@indexForProject');
//        $crawler = $this->client->request('GET', 'indexForProject');
//        
//        
//        $this->assertContains('Volunteer Hours for',$response->getContent());
//        $this->assertTrue($this->client->getResponse()->isOk());
//        $this->assertCount(1, $crawler->filter('th:contains("Hours")'));
//    }
    
        
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
        $this->mockedVolunteerHoursController->shouldReceive('storeHoursEntryWith')->once()->with($this->volunteerHoursInput);
        $this->mockedVolunteerHoursRepo->shouldReceive('saveVolunteerHours')->once()->with(Mockery::type('VolunteerHours'));

        // Act 
        $response = $this->route("POST", "storehours", $this->volunteerHoursInput);

        // Assert
        $this->assertRedirectedToAction('VolunteerHoursController@indexForProject',1);
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
                ->shouldReceive('getHoursForVolunteer')->once()->with(1);
        
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $this->call('GET','volunteerhours/volunteerEdit/1');
        
        $this->assertResponseOk();
        
    }
    
    

    
}


