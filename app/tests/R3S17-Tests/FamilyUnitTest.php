<?php

/**
 * Description of FamilyUnitTest
 *
 * @author cst220
 */
class FamilyUnitTest extends TestCase
{
    
    protected $mockedFamilyRepo;
    protected $mockedFamilyContactRepo;
    protected $mockedVolunteerHoursRepo;
    protected $mockedFamilyController;
    
    protected $testController;
    
    protected $familyInput;
    protected $familyContactInput;
    
    /*
     * Set up the function for the tests. Creates dummy objects to use for Testing.
     */
    public function setUp() 
    {
        parent::setUp();
        
        //Create dummy Family information
        $this->familyInput = [
            'id' => '50',
            'name' => 'Johnson',
            'status' => 'pending',
            'comments' => 'next on the list for a house.'
        ];
        
        //Create dummy FamilyContact information
        $this->familyContactInput[0] = [
            'family_id' => '002',
            'contact_id' => '065',
            'primary' => 'true',
            'currently_active' => 'true'
        ];
        
        $this->familyContactInput[1] = [
            'family_id' => '002',
            'contact_id' => '072',
            'primary' => 'true',
            'currently_active' => 'true'
        ];
        
        $this->familyContactInput[2] = [
            'family_id' => '002',
            'contact_id' => '083',
            'primary' => 'false',
            'currently_active' => 'true'
        ];
        
        $this->familyContactInput[3] = [
            'family_id' => '002',
            'contact_id' => '048',
            'primary' => 'false',
            'currently_active' => 'true'
        ];
        
        $this->familyInput['contacts'] = $this->familyContactInput;
        
        // Instantiate mocked objects with dummy data
        $this->mockedFamilyRepo = Mockery::mock('app\repositories\FamilyRepository');
        $this->app->instance('app\repositories\FamilyRepository', $this->mockedFamilyRepo);
        
        $this->mockedFamilyContactRepo = Mockery::mock('app\repositories\FamilyContactRepository');
        $this->app->instance('app\repositories\FamilyContactRepository', $this->mockedFamilyContactRepo);
        
        $this->mockedVolunteerHoursRepo = Mockery::mock('app\repositories\VolunteerHoursRepository');
        $this->app->instance('app\repositories\VolunteerHoursRepository', $this->mockedVolunteerHoursRepo);
        
        $this->mockedFamilyController = Mockery::mock('app\controllers\FamilyController');
        $this->app->instance('app\controllers\FamilyController', $this->mockedFamilyController);
        
        $this->testController = new FamilyController($this->mockedFamilyRepo, $this->mockedFamilyContactRepo, $this->mockedVolunteerHoursRepo);
        
    }
    
    /*
     * Test that the system can successfully add a family to the database
     */
    public function testStoreFamilySuccess()
    {
        //Assemble
        //$this->mockedFamilyController->shouldReceive('createFamilyWith')->once()->with($this->familyInput);
        $this->mockedFamilyRepo->shouldReceive('saveFamily')->once()->with(Mockery::type('Family'));
        
        //Redirect::shouldReceive('action')->once()->with('FamilyController@show')->with($this->familyInput);
        
        //Act
        $response = $this->route("POST", "family.store", $this->familyInput);
        
        //Assert
        $this->assertTrue($response->isRedirect());
        $this->assertRedirectedToAction('FamilyController@show');
    }
    
    /*
     * Test that the appropriate data is added to the FamilyContact table
     * when a Family is created
     */
    public function testStoreFamilyContactSuccess()
    {
        //Assemble
        $numberOfContacts = count($this->familyInput['contacts']);
        $this->mockedFamilyController->shouldReceive('createFamilyContactWith')->times($numberOfContacts)->with($this->familyContactInput[0]);
        $this->mockedFamilyContactRepo->shouldReceive('saveFamilyContact')->times($numberOfContacts)->with(Mockery::type('FamilyContact'));
        $this->mockedFamilyRepo->shouldReceive('saveFamily')->once()->with(Mockery::type('Family'));
        
        //Redirect::shouldReceive('action')->once()->with('FamilyController@show');
        
        //Act
        $response = $this->route("POST", "family.store", $this->familyInput);
        
        //Assert
        $this->assertTrue($response->isRedirect());
        $this->assertRedirectedToAction('FamilyController@show');
    }
    
    /*
     * Test that the system can gracefully handle not successfully creating a family     * 
     */
    public function OFF_testStoreFamilyFails()
    {
        //TODO: Make a test that will fail when a family is created
    }
    
    /*
     * Test that the system can gracefully handle not successfully passing Family
     * info to FamilyContact
     */
    public function OFF_testStoreFamilyContactFails()
    {
        //TODO: Make a test that will fail with a family is created
    }
    
    /*
     * Test that the family view gets called
     */
    public function testView()
    {
        //Call the method
        $response = $this->call('GET', 'family/create');
        
        //Make assertions
        $this->assertContains('Family', $response->getContent());
    }
    
    /*
     * Test that the appropriate view is created
     */
    public function testCreate()
    {
        $response = $this->action('GET', 'FamilyController@create');
        $crawler = $this->client->request('GET', 'create');
        
        $this->assertContains('Create a Family', $response->getContent());
        $this->assertTrue($this->client->getResponse()->isOK());
        $this->assertCount(1, $crawler->filter('label:contains("Family Name")'));
        $this->assertCount(2, $crawler->filter('label:contains("Primary Contact")'));
    }
    
    /*
     * Test helper method that creates a family object and passes it to the repository
     */
    public function testCreateFamilyWith()
    {
        //Assemble
        $this->mockedFamilyRepo->shouldReceive('saveFamily')->once()->with(Mockery::type('Family'));
        
        //Act
        $this->testController->createFamilyWith($this->familyInput);
    }
    
    /*
     * Test helper method that creates FamilyContact info
     */
    public function testCreateFamilyContactWith()
    {
        //Assemble
        $this->mockedFamilyContactRepo->shouldReceive('saveFamilyContact')->once()
                ->with(Mockery::type('FamilyContact'));
        
        //Act
        $this->testController->createFamilyContactWith($this->familyContactInput[0]);
    }   
    
    /*
     * Test that the helper method passes values into the repository methods
     */
    public function testCreateFamilyWithReceivesFamilyInfo()
    {
        //Assemble
        $familyInput = $this->familyInput;
        
        $this->mockedFamilyRepo->shouldReceive('saveFamily')
                ->once()
                ->with(Mockery::on(
                        function($passedInFamilyInfo) use($familyInput)
                {
                 $this->assertNull($passedInFamilyInfo['id']);
                 $this->assertEquals($familyInput['name'], $passedInFamilyInfo['name']);
                 
                 return true;
                 
                }
                ));
                
        //Act
        $this->testController->createFamilyWith($this->familyInput);
    }
    
    /*
     * Test that the helper method passes values into the repository methods
     */
    public function testCreateFamilyContactWithReceivesFamilyContactInfo()
    {
        //Assemble
        $familyContactInput = $this->familyContactInput[0];
        
        $this->mockedFamilyContactRepo->shouldReceive('saveFamilyContact')
                ->once()
                ->with(Mockery::on(
                        function($passedInFamilyContactInfo) use($familyContactInput)
                {
                    $this->assertNotNull($passedInFamilyContactInfo['family_id']);
                    $this->assertEquals($familyContactInput['primary'], $passedInFamilyContactInfo['primary']);
                    
                    return true;
                }
                ));
                
        //Act
        $this->testController->CreateFamilyContactWith($this->familyContactInput[0]); 
    }
    
    /*
     * Purpose: Test that the show method displays the appropriate family details
     */
    public function OFF_testShow()
    {
        //Assemble
        // Taken care of in SetUp()
        
        //Act
        // Call action to show, passing in the family information
        
        //Assert
        // Test that the view created successfully and contains some information
        // that was passed in.
    }
    
    /*
     * Test clean up
     */
    public function tearDown()
    {
        Mockery::close();
    }
    
    
    
    
}
