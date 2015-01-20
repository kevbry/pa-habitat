<?php

/**
 * Description of VolunteerHoursTest
 *
 * @author cst222
 */
class VolunteerHoursTest extends VolunteerHours 
{
    protected $mockedVolunteerHoursRepo;
    protected $mockedVolunteerHoursController;
    protected $volunteerHoursInput;
    
    protected $invalidDataException;
    
    public function setUp()
    {
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
    public function testCreate()
    {
        $response = $this->action('GET', 'VolunteerHoursController@create');
        $crawler = $this->client->request('GET', 'create');
        
        $this->assertContains('Add Volunteer Hours',$response->getContent());
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('label:contains("Hours:")'));
    }
    
    
    /**
     * Test that the controller can sucessfully add hours to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        // Assemble
        $this->mockedVolunteerHoursController->shouldReceive('storeHoursEntryWith')->once()->with($this->volunteerHoursInput);
        $this->mockedVolunteerHoursRepo->shouldReceive('saveVolunteerHours')->once()->with(Mockery::type('VolunteerHours'));


        //Redirect::shouldReceive('action')->once()->with('VolunteerHoursController@show');

        // Act 
        $response = $this->route("POST", "volunteerHours.create", $this->volunteerHoursInput);

        // Assert
        $this->assertResponseOK();
        //$this->assertRedirectedToRoute('volunteerHours.create', $response);
    }
    
    public function testStoreSingleEntryFailure()
    {
        $this->volunteerHoursInput = [];
        
        // Assemble
        $this->mockedVolunteerHoursController
                ->shouldReceive('storeHoursEntryWith')
                ->once()
                ->with($this->volunteerHoursInput)
                ->andThrow($this->invalidDataException);

        // Act 
        $response = $this->route("POST", "volunteerHours.create", $this->volunteerHoursInput);
    }
    
    public function testIndexForProject()
    {
        $this->mockedVolunteerHoursRepo
                ->shouldReceive('getHoursForProject')->once();
        
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $this->call('GET','volunteerHours.indexForProject');
        
        $this->assertViewHas('volunteerhours');
    }
    
    
}


