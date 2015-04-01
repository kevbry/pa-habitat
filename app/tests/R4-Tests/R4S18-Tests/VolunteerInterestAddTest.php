<?php
 
class VolunteerInterestAddTest extends TestCase 
{
   protected $mockedVolunteerInterestRepo;
    protected $mockedVolunteerInterestController;
    protected $volunteerInteretsInput;
    
    protected $invalidDataException;
    
    public function setUp()
    {
        parent::setUp();
        //TODO - Populate array with a dummy entry for the projectitem table
        $this->volunteerInteretsInput = [];

        // Set up the Volunteer Interest Item Mocked Repository
        $this->mockedVolunteerInterestRepo = Mockery::mock('App\Repositories\EloquentVolunteerInterestRepository');
        $this->app->instance('App\Repositories\EloquentVolunteerInterestRepository', $this->mockedVolunteerInterestRepo);
        
        $this->mockedVolunteerInterestController = Mockery::mock('App\Controllers\VolunteerInterestController');
        $this->app->instance('App\Controllers\VolunteerInterestController', $this->mockedVolunteerInterestController);
        
    }
    
    /**
     * Test that the controller can sucessfully add items to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->volunteerInteretsInput = [
            'id'=>'5',
            'volunteer_id' => 2, 
            'interest' => 5,
            'comments'=>'Interesting!'
         ];
         
        $this->mockedVolunteerInterestRepo->shouldReceive('saveVolunteerInterest')->once()->with(Mockery::type('VolunteerInterest'));

        // Act 
          $response = $this->route("POST", "storeInterests", $this->volunteerInteretsInput);

        // Assert
        $this->assertRedirectedToAction('ContactController@show',2);
    }
    
    //TODO: Finish this test so it properly tests for failing to store a single entry
    public function OFF_testStoreSingleEntryFailure()
    {
        $this->volunteerInteretsInput = [];
        
//        // Assemble
//        $this->mockedProjectItemController
//                ->shouldReceive('store')
//                ->once()
//                ->with($this->projectItemInput)
//                ->andThrow(new Exception());
        
        // This test does not appear to be finished.
        $this->markTestIncomplete('This test has not been properly implemented yet');
    }
 
    public function testCreate()
    {
       $this->mockedVolunteerInterestRepo
            ->shouldReceive('getVolunteerInterests')->once()->with(2)
               ->passthru();

        //Call the method
        $response = $this->call('GET', 'volunteer/2/interest/create');
        
        //Make assertions
        $this->assertContains('Interests for', $response->getContent());
        $this->assertTrue($this->client->getResponse()->isOk());
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


