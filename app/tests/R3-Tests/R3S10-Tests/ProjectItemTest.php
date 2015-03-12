<?php
 
class ProjectItemTest extends TestCase 
{
    protected $mockedProjectItemRepo;
    protected $mockedProjectItemController;
    protected $projectItemInput;
    
    protected $invalidDataException;
    
    public function setUp()
    {
        parent::setUp();
        $this->projectItemInput = [];

        // Set up the Project Item Mocked Repository
        $this->mockedProjectItemRepo = Mockery::mock('App\Repositories\EloquentProjectItemRepository');
        $this->app->instance('App\Repositories\ProjectItemRepository', $this->mockedProjectItemRepo);
        
//        $this->mockedProjectItemController = Mockery::mock('app\controllers\ProjectItemController');
//        $this->app->instance('app\controllers\ProjectItemController', $this->mockedProjectItemController);
        
    }
        
    /**
     * Test that the controller can sucessfully add items to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->projectItemInput = [
            'id' => '555',
            'project_id' => 2, 
            'item_type' => 'Refrigerator',
            'manufacturer' => 'Acme Ltd.',
            'model' => 'Super Cold 3000',
            'serial_number' => 'ABJ-9137-WOW3042',
            'vendor' => 'Awesome Shop',
            'comments' => 'Came with free bag of hot dogs'
         ];
        
        // Assemble
        //$this->mockedProjectItemController->shouldReceive('store')->once();
        $this->mockedProjectItemRepo->shouldReceive('saveProjectItem')->once()->with(Mockery::type('ProjectItem'));

        // Act 
        $response = $this->route("POST", "storeItems", $this->projectItemInput);

        // Assert
        $this->assertRedirectedToAction('ProjectItemController@index',2);
    }
    
    //TODO: Finish this test so it properly tests for failing to store a single entry
    public function OFF_testStoreSingleEntryFailure()
    {
        $this->projectItemInput = [];
        
//        // Assemble
//        $this->mockedProjectItemController
//                ->shouldReceive('store')
//                ->once()
//                ->with($this->projectItemInput)
//                ->andThrow(new Exception());
        
        // This test does not appear to be finished.
        $this->markTestIncomplete('This test has not been properly implemented yet');
    }
    
    public function testIndex()
    {
        $this->mockedProjectItemRepo
            ->shouldReceive('getItemsForProject')->once()->with(2)
            ->passthru();
        
        $this->call('GET','/project/2/items');
        
        $this->assertResponseOk();
        
    } 
    
    public function testCreate()
    {
       $this->mockedProjectItemRepo
            ->shouldReceive('getItemsForProject')->once()->with(2)
               ->passthru();

        //Call the method
        $response = $this->call('GET', 'project/2/items');
        
        //Make assertions
        $this->assertContains('Items for', $response->getContent());
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


