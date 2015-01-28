<?php
/**
 * Description of ProjectUnitTests
 *
 * @author cst217, cst220, cst222
 * 
 */
class ProjectUnitTests extends TestCase {
    
    protected $mockedProjectRepo;
    protected $mockedProjectContactRepo;
    protected $mockedProjectController; 
    
    protected $testController;
      
    protected $projectInput;
    protected $projectContactInput;


    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        parent::setUp();

        // Create dummy Project information
        $this->projectInput = [
            'id' => '33',
            'family_id' => '22',
            'blueprint_id' => '45',
            'project_name' => '123 fake street',
            'street_number' => '123 fake street',
            'city'=> 'Calgary',
            'province' => 'AB',
            'postal_code' => 'S7R 4J2',
            'project_coordinator' => 'Merve Murphy',
            'start_date' => '12-02-2015',
            'end_date' => '',
            'blueprint_designer' => 'Blueprint Bob',
            'blueprint_plan_number' => '12G435',
            'building_permit_number' => '8472616',
            'building_permit_date' => '15-01-2015',
            'mortgage_data' => '17-05-2016',
            'comments' => 'My first house'
           ];
        
        
        $this->projectContactInput = [
            'contact_id' => '5',
            'project_id' => '33',
            'role' => 'Project Coordinator'
             ];
        

        $this->projectInput['contact'] = $this->projectContactInput;

        
        //Instantiate mocked objects with dummy data
        $this->mockedProjectRepo = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->mockedProjectRepo);
        
        $this->mockedProjectContactRepo = Mockery::mock('app\repositories\ProjectContactRepository');
        $this->app->instance('app\repositories\ProjectContactRepository', $this->mockedProjectContactRepo);
        
        $this->testController = new ProjectController($this->mockedProjectRepo, $this->mockedProjectContactRepo);
        
        // Instantiate house object with the data objects 
        
        
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
