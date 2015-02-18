<?php

class InspectionInfoTest extends TestCase
{
    protected $mockedProjectInspection;
    protected $mockedProjectInspectionController;
    protected $projectInspectionInput;
    
    protected $invalidDataException;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->projectInspectionInput = [];
        
        // Set up the Project Inspection Mocked Repository
        $this->mockedProjectInspection = Mockery::mock('app\repositories\ProjectInspectionRepository');
        $this->app->instance('app\repositories\ProjectInspectionRepository', $this->mockedProjectInspection);
        
        $this->mockedProjectInspectionController = Mockery::mock('app\controllers\ProjectInspectionController');
        $this->app->instance('app\controllers\ProjectInspectionController', $this->mockedProjectInspectionController);       
    }
    
    /**
     * Test that the controller can sucessfully add items to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->projectInspectionInput = [
            'id' => '839',
            'project_id' => 1, 
            'mandatory' => 1,
            'date' => '12-02-2015',
            'type' => 'Electrical',
            'pass' => 1,
            'comments' => 'Wiring is well done. Outlets are a little crooked.'
         ];
        
        // Assemble
        $this->mockedProjectInspectionController->shouldReceive('store')->once()->with($this->projectInspectionInput);
        $this->mockedProjectInspectionRepo->shouldReceive('saveProjectInspection')->once()->with(Mockery::type('ProjectInspection'));

        // Act 
        $response = $this->route("POST", "storeInspectionWith", $this->projectInspectionInput);

        // Assert
        $this->assertRedirectedToAction('ProjectInspectionController@index', 1);
    }
    
    public function testStoreSingleEntryFailure()
    {
        $this->projectInspectionInput = [];
        
        // Assemble
        $this->mockedProjectInspectionController
                ->shouldReceive('store')
                ->once()
                ->with($this->projectInspectionInput)
                ->andThrow(new Exception());
    }
    
    public function testIndex()
    {
        $this->mockedProjectInspectionController
                ->shouldReceive('getInspectionsForProject')->once()->with(1);
        
        $this->app->instance('app\repositories\ProjectInspectionRepository', $this->mockedProjectInspectionRepo);
        
        $this->call('GET','/project/1/inspections');
        
        $this->assertResponseOk();
    } 
    
    public function testCreate()
    {
       //Call the method
        $response = $this->call('GET', 'project/1/inspections');
        $crawler = $this->client->request('GET', 'create');
        
        //Make assertions
        $this->assertContains('Project Inspections for', $response->getContent());
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('label:contains("Type:")'));
    }
}

