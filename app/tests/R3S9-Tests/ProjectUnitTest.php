<?php
class ProjectUnitTest extends TestCase {
    
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
        
        $this->mockedProjectController = Mockery::mock('app\controllers\ProjectController');
        $this->app->instance('app\controllers\ProjectController', $this->mockedProjectController);      
    }
    
    /**
     * Purpose: Test the store method for sucessfully storing a volunteer
     */
    public function testStoreProjectSuccess()
    {
        // Assemble
        $this->mockedProjectController->shouldReceive('createProjectWith')->once()->with($this->projectInput);
        $this->mockedProjectRepo->shouldReceive('saveProject')->once()->with(Mockery::type('Project'));
        
        //Act
        $response = $this->route("POST", "project.store", 33);
        
        $this->assertContains('Redirecting', $response->getContent());
        $this->assertContains('project', $response->getContent());
    }
    
//    
//    /**
//     * 
//     */
    public function testStoreProjectFails()
    {
        //TODO: Make a test that will fail with a Project is created        
    }
    
    /**
     * 
     */
    public function testStoreProjectContactFails()
    {
        //TODO: Make a test that will fail with a ProjectContact is created        
    }
    
    /**
     * Test the Project view gets called
     */
    public function testView()
    {
       //Call the method
        $response = $this->call('GET', 'project/create');
        
        //Make assertions
        $this->assertContains('Project', $response->getContent());
    }
    
    /**
     * Test that the appropriate view is created
     */
    public function testCreate()
    {
        $response = $this->action('GET', 'ProjectController@create');
        $crawler = $this->client->request('GET', 'create');
        
        $this->assertContains('Create a Project', $response->getContent());
        $this->assertTrue($this->client->getResponse()->isOk());
        
    }

//        
//   /*
//    *  Test that the helper method passes values into the repository methods
//    */
    public function  testStoreProjectWithReceivesProjectInfo()
    {
      //Assemble 
      $projectInput = $this->projectInput;
      
      $this->mockedProjectRepo->shouldReceive('saveProject')->once()->with(Mockery::on(
                function($passedInProjectInfo) use($projectInput)
                {
                    $this->assertNull($passedInProjectInfo['id']);
                    $this->assertEquals($projectInput['project_name'], $passedInProjectInfo['project_name']);
                    return true;
                }
                ));
                
        //Act
        $response = $this->route("POST", "project.store", $projectInput);
        
        $this->assertContains('Redirecting', $response->getContent());
        $this->assertContains('project', $response->getContent());
    }

}
