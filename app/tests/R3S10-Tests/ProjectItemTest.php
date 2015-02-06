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
        $this->$projectItemInput = [];

        // Set up the Volunteer Hours Mocked Repository
        $this->$mockedProjectItemRepo = Mockery::mock('app\repositories\ProjectItemRepository');
        $this->app->instance('app\repositories\ProjectItemRepository', $this->$mockedProjectItemRepo);
        
        $this->$mockedProjectItemController = Mockery::mock('app\controllers\ProjectItemController');
        $this->app->instance('app\controllers\ProjectItemController', $this->$mockedProjectItemController);
        
    }
        
    /**
     * Test that the controller can sucessfully add items to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->projectItemInput = [
            'id' => '555',
            'project_id' => 1, 
            'item_type' => 'Refrigerator',
            'manufacturer' => 'Acme Ltd.',
            'model' => 'Super Cold 3000',
            'serial_number' => 'ABJ-9137-WOW3042',
            'vendor' => 'Awesome Shop',
            'comments' => 'Came with free bag of hot dogs'
         ];
        
        // Assemble
        $this->mockedProjectItemController->shouldReceive('store')->once()->with($this->projectItemInput);
        $this->mockedProjectItemRepo->shouldReceive('saveProjectItem')->once()->with(Mockery::type('ProjectItem'));

        // Act 
        $response = $this->route("POST", "storeItems", $this->projectItemInput);

        // Assert
        $this->assertRedirectedToAction('ProjectItemController@index',1);
    }
    
    public function testStoreSingleEntryFailure()
    {
        $this->projectItemInput = [];
        
        // Assemble
        $this->mockedProjectItemController
                ->shouldReceive('store')
                ->once()
                ->with($this->projectItemInput)
                ->andThrow(new Exception());
    }
    
    public function testIndex()
    {
        $this->mockedProjectItemController
                ->shouldReceive('getItemsForProject')->once()->with(1);
        
        $this->app->instance('app\repositories\ProjectItemRepository', $this->mockedProjectItemRepo);
        
        $this->call('GET','/project/1/items');
        
        $this->assertResponseOk();
        
    } 
    
    public function testCreate()
    {
       //Call the method
        $response = $this->call('GET', 'project/1/items');
        
        //Make assertions
        $this->assertContains('Project Items for', $response->getContent());
        $this->assertTrue($this->client->getResponse()->isOk());
    }
    
}


