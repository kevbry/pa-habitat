<?php
 
class VolunteerInterestEditTest extends TestCase 
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
        $this->mockedVolunteerInterestRepo = Mockery::mock('app\repositories\VolunteerInterestRepository');
        $this->app->instance('app\repositories\VolunteerInterestRepository', $this->mockedVolunteerInterestRepo);
        
        $this->mockedVolunteerInterestController = Mockery::mock('app\controllers\VolunteerInterestController');
        $this->app->instance('app\controllers\VolunteerInterestController', $this->mockedVolunteerInterestController);
        
    }
        
    /**
     * Test that the controller can successfully edit items in the database
     */
    public function testSaveUpdates()
    {
        $this->volunteerInteretsInput = [
            'id' => '555', 
            'volunteer_id' => 1, 
            'interest_id' => 62,
             
         ];
        // Assemble
        
        $this->mockedVolunteerInterestRepo->shouldReceive('saveVolunteerInterest')->once()->with(Mockery::type('VolunteerInterest'));

        // Act 
        $response = $this->route("POST", "storeInterests", $this->volunteerInteretsInput);

        // Assert
        $this->assertRedirectedToAction('ContactController@show',1);
    }
    
    //TODO: Finish this test so it properly tests for failing to store a single entry
    public function OFF_testStoreSingleEntryFailure()
    {
        $this->volunteerInteretsInput = [];
        
        // Assemble
        $this->mockedVolunteerInterestController
                ->shouldReceive('store')
                ->once()
                ->with($this->volunteerInteretsInput)
                ->andThrow(new Exception());
        
        // This test does not appear to be finished.  :(
        $this->markTestIncomplete('This test has not been properly implemented yet');
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


