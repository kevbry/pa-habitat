<?php

/**
 * Unit tests for the Contact Controller class
 */
class ProjectUnitTests extends TestCase {
    
    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        parent::setUp();

        // Create dummy Contact information
        $projectInput = [
            'id' => '33',
            'name' => 'Test House',
            'location'=> '289 Spruce Avenue',
            'family'=> 'Bruce and Anne Gable',
            'Items'=>'A washing machine',
            'Volunteers'=>'',
            'Comments'=>''
         ];
        
        // Instantiate house object with the data objects 
        $this->testProject = new Project($projectInput);
        
    }
    
    /**
     * Purpose: Test the store method for sucessfully storing a volunteer
     */
    public function OFF_testStoreProjectSuccess()
    {
        // Assemble
        $mockedProjectRepo = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app/repositories/ProjectRepository', $mockedProjectRepo);
        
        $mockedProjectRepo->shouldReceive('saveProject')->once()->with($this->testProject);
        
        $testController = new ProjectController($mockedProjectRepo);

        // Act    
        $this->call("GET", "project/store");
        
        // Assert
        $this->assertEquals(33, $this->testProject->id);
    }
    
    /** 
     * Function for cleaning up after tests ar complete
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
