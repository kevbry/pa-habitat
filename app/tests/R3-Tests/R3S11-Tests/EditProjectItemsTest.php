<?php
 
class EditProjectItemsTest extends TestCase 
{
    protected $mockedProjectItemsRepo;
    protected $mockedProjectItemsController;
    protected $projectItemInput;
    
    protected $invalidDataException;
    
    public function setUp()
    {
        parent::setUp();
        //TODO - Populate array with a dummy entry for the projectitem table
        $this->projectItemInput = [];

        // Set up the Project Item Mocked Repository
        $this->mockedProjectItemsRepo = Mockery::mock('app\repositories\ProjectItemRepository');
        $this->app->instance('app\repositories\ProjectItemRepository', $this->mockedProjectItemsRepo);
        
        $this->mockedProjectItemsController = Mockery::mock('app\controllers\ProjectItemController');
        $this->app->instance('app\controllers\ProjectItemController', $this->mockedProjectItemsController);
        
    }
        
    /**
     * Test that the controller can successfully edit items in the database
     */
    public function testSaveUpdates()
    {
        $this->projectItemInput = [
            'id' => '555', 
            'project_id' => 1, 
            'item_type' => 'Refrigerator',
            'manufacturer' => 'Cool Guys Manufacturing',
            'model' => 'coolycool5000',
            'serial_number' => '9238JDFH03uihFD', 
            'vendor' => 'LindenMart',
            'comments' => 'Handles upsidedown'
         ];
        // Assemble
        //$this->mockedProjectItemsController->shouldReceive('storeItemWith')->once()->with($this->projectItemInput);
        $this->mockedProjectItemsRepo->shouldReceive('saveProjectItem')->once()->with(Mockery::type('ProjectItem'));

        // Act 
        $response = $this->route("POST", "storeItems", $this->projectItemInput);

        // Assert
        $this->assertRedirectedToAction('ProjectItemController@index',1);
    }
    
    //TODO: Finish this test so it properly tests for failing to store a single entry
    public function OFF_testStoreSingleEntryFailure()
    {
        $this->projectItemInput = [];
        
        // Assemble
        $this->mockedProjectItemsController
                ->shouldReceive('store')
                ->once()
                ->with($this->projectItemInput)
                ->andThrow(new Exception());
        
        // This test does not appear to be finished.
        $this->markTestIncomplete('This test has not been properly implemented yet');
    }
    
     public function testIndexForProject()
    {
        $this->mockedProjectItemsRepo
                ->shouldReceive('getItemsForProject')->once()->with(2);
        
        $this->app->instance('app\repositories\ProjectItemRepository', $this->mockedProjectItemsRepo);
        
        $this->call('GET','project/2/items');
        //$response = $this->route("GET", "viewItems", 1);
        
        $this->assertResponseOk();
        
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


