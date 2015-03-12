<?php
 
class EditProjectInspectionsTest extends TestCase 
{
    protected $mockedProjectInspectionsRepo;
    protected $mockedProjectInspectionsController;
    protected $projectInspectionInput;
    
    protected $invalidDataException;
    
    public function setUp()
    {
        parent::setUp();
        //TODO - Populate array with a dummy entry for the projectitem table
        $this->projectInspectionInput = [];

        // Set up the Project Inspection Mocked Repository
        $this->mockedProjectInspectionsRepo = Mockery::mock('app\repositories\ProjectInspectionRepository');
        $this->app->instance('app\repositories\ProjectInspectionRepository', $this->mockedProjectInspectionsRepo);
        
        $this->mockedProjectInspectionsController = Mockery::mock('app\controllers\ProjectInspectionController');
        $this->app->instance('app\controllers\ProjectInspectionController', $this->mockedProjectInspectionsController);
        
    }
        
    /**
     * Test that the controller can successfully edit items in the database
     */
    public function testSaveUpdates()
    {
        $this->projectInspectionInput = [
            'id' => '555', 
            'project_id' => 1, 
            'mandatory' => 1, 
            'date' => '2015-05-04',
            'type' => 'Electrical',
            'pass' => 1,
            'comments' => 'Handles upsidedown'
         ];
        // Assemble
        //$this->mockedProjectInspectionsController->shouldReceive('storeInspectionWith')->once()->with($this->projectInspectionInput);
        $this->mockedProjectInspectionsRepo->shouldReceive('saveProjectInspection')->once()->with(Mockery::type('ProjectInspection'));

        // Act 
        $response = $this->route("POST", "storeInspections", $this->projectInspectionInput);

        // Assert
        $this->assertRedirectedToAction('ProjectInspectionController@index',1);
    }
    
    //TODO: Finish this test so it properly tests for failing to store a single entry
    public function OFF_testStoreSingleEntryFailure()
    {
        $this->projectInspectionInput = [];
        
        // Assemble
        $this->mockedProjectInspectionsController
                ->shouldReceive('store')
                ->once()
                ->with($this->projectInspectionInput)
                ->andThrow(new Exception());
        
        // This test does not appear to be finished.
        $this->markTestIncomplete('This test has not been properly implemented yet');
    }
    
     public function testIndexForProject()
    {
        $this->mockedProjectInspectionsRepo
                ->shouldReceive('getInspectionsForProject')->once()->with(2);
        
        $this->app->instance('app\repositories\ProjectInspectionRepository', $this->mockedProjectInspectionsRepo);
        
        $this->call('GET','project/2/inspections');
        //$response = $this->route("GET", "viewInspections", 1);
        
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



