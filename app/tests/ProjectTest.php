<?php

/**
 * Unit tests for the Contact Controller class
 */
class ProjectTest extends TestCase {
    
    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        parent::setUp();

        // Create dummy Contact information
        $projectInput = [
            'id' => '33',
            'name' => 'Cool House'
         ];
        
        // Instantiate objects with dummy data
        $this->testProject = new Project($projectInput);
        
    }
    
    /**
     * Purpose: Test the store method for sucessfully storing a volunteer
     */
    public function testStoreProjectSuccess()
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
