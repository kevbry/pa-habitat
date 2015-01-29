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
    public function testStoreProjectSuccess()
    {
        // Assemble
        $this->mockedProjectController->shouldReceive('storeProjectWith')->once()->with($this->projectInput);
        $this->mockedProjectRepo->shouldReceive('saveProject')->once()->with(Mockery::type('Project'));
        
        Redirect::shouldReceive('action')->once()->with('ProjectController@show');
        
        //Act
        $response = $this->route("POST", "family.store", $this->projectInput);        
         
        //Assert
        $this->assertTrue("project_name", $response);
        
    }
    
    /**
     * 
     */
    public function testStoreProjectContactSuccess()
    {
        //Assemble
        $this->mockedProjectController->shouldRecieve('storeProjectContactWith')->once()->with($this->projectContactInput);
        $this->mockedProjectContactRepo->shouldReceive('saveProjectContact')->once()->with(Mockery::type('ProjectContact'));
        
         Redirect::shouldReceive('action')->once()->with('ProjectController@show');
         
         //Act
         $response = $$this->route("POST", "project.store", $this->projectInput);
         
         //Assert
         $this->assertTrue("role", $response);
    }
    
    /**
     * 
     */
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
        
        $this->assertCount(1, $crawler->filter('label:contains("Project name")'));
        $this->assertCount(1, $crawler->filter('label:cotains("Project coordinator")'));
    }
    
    /**
     * Test helper method that creates a project object and passes it to the repository
     */
    public function testStoreProjectWith()
    {
        //Assemble
        $this->mockedProjectRepo->shouldReceive('saveProject')->once()->with(Mockery::type('Project'));
        
        //Act
        $this->testController->storeFamilyWith($this->projectInput);
    }
    
    /*
     * Test helper method that create ProjectContact info
     */
    public function testStoreProjectContactWith()
    {
        //Assemble
        $this->mockedProjectContactRepo->shouldReceive('saveProjectContact')->once()->with(Mockery::type('ProjectContact'));
        
        //Act
        $this->testController->storeProjectContactWith($this->projectContactInput);
    }
        
   /*
    *  Test that the helper method passes values into the repository methods
    */
    public function  testStoreProjectWithReceivesProjectInfo()
    {
      //Assemble 
      $projectInput = $this->projectInput;
      
      $this->mockedProjectRepo->shouldReceive('saveProject')->once()->with(Mockery::on(
                function($passedInProjectInfo) use($projectInput)
                {
                    $this->assertNull($passedInProjectInfo['id']);
                    $this->assertEquals($projectInput['proejct_name'], $passedInProjectInfo['project_name']);
                    return true;
                }
                ));
                
        //Act
        $this->testController->storeProjectWith($this->projectInput);
    }
    
    /**
     * Test that the helper method passes values into the repository methods
     */
    public function testStoreProjectContactWithReceivesProjectContactInfo()
    {
       //Assemble
        $projectContactInput = $this->projectContactInput;
        
        $this->mockedProjectContactRepo->shouldReceive('saveProjectContact')->once()->with(Mockery::on(
                        function($passedInProjectContactInfo) use($projectContactInput)
                        {
                            $this->assertNotNull($passedInContactInfo['project_id']);
                            $this->assertEquals($projectContactInput['primary'], $passedInContactInfo['primary']);
                            return true;                             
                        }));
       //Act
       $this->testController->storeProjectContactWith($this->projectContactInput);
    }
    
    /**
     * 
     */
    public function OFF_testStoreRedirect()
    {
        //Assemble
        $this->mockedProjectRepo->shouldReceive('saveProject')->once()->with($this->testProject);
        
        //Act
        $this->call('GET', 'project/store');
        
        //Assert
        $this->assertRedirectedToRoute('project.show');
    }
    /** 
     * Function for cleaning up after tests ar complete
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
