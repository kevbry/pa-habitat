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
        
        $this->testController = new FamliyController($this->mockedFamilyRepo, $this->mockedFamilyContactRepo);
        
    }
    
    /*
     * Test that the system can successfully add a family to the database
     */
    public function testStoreFamilySuccess()
    {
        //Assemble
        $this->mockedFamilyController->shouldReceive('storeFamilyWith')->once()->with($this->familyInput);
        $this->mockedFamilyRepo->shouldReceive('saveFamily')->once()->with(Mockery::type('Family'));
        
        Redirect::shouldReceive('action')->once()->with('FamilyController@show');
        
        //Act
        $response = $this->route("POST", "family.store", $this->familyInput);
        
        //Assert
        $this->assertTrue("name", $response);
    }
    
    /*
     * Test that the appropriate data is added to the FamilyContact table
     * when a Family is created
     */
    public function testStoreFamilyContactSuccess()
    {
        //Assemble
        $numberOfContacts = count($this->familyInput['contacts']);
        $this->mockedFamilyController->shouldReceive('storeFamilyContactWith')->times($numberOfContacts)->with($this->familyContactInput[0]);
        $this->mockedFamilyContactRepo->shouldReceive('saveFamilyContact')->times($numberOfContacts)->with(Mockery::type('FamilyContact'));
        
        Redirect::shouldReceive('action')->once()->with('FamilyController@show');
        
        //Act
        $response = $this->route("POST", "family.store", $this->familyInput);
        
        //Assert
        $this->assertTrue("primary", $response);
    }
    
    /*
     * Test that the system can gracefully handle not successfully creating a family     * 
     */
    public function testStoreFamilyFails()
    {
        //TODO: Make a test that will fail when a family is created
    }
    
    /*
     * Test that the system can gracefully handle not successfully passing Family
     * info to FamilyContact
     */
    public function testStoreFamilyContactFails()
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
        $this->assertCount(1, $crawler->filter('label:contains("Family name")'));
        $this->assertCount(2, $crawler->filter('label:contains("Primary contact")'));
    }
    
    /*
     * Test helper method that creates a family object and passes it to the repository
     */
    public function testStoreFamilyWith()
    {
        //Assemble
        $this->mockedFamilyRepo->shouldReceive('saveFamily')->once()->with(Mockery::type('Family'));
        
        //Act
        $this->testController->storeFamilyWith($this->familyInput);
    }
    
    /*
     * Test helper method that creates FamilyContact info
     */
    public function testStoreFamilyContactWith()
    {
        //Assemble
        $this->mockedFamilyContactRepo->shouldReceive('saveFamilyContact')->once()
                ->with(Mockery::type('FamilyContact'));
        
        //Act
        $this->testController->storeFamilyContactWith($this->familyContactInput[0]);
    }   
    
    /*
     * Test that the helper method passes values into the repository methods
     */
    public function testStoreFamilyWithReceivesFamilyInfo()
    {
        //Assemble
        $familyInput = $this->familyInput;
        
        $this->mockedFamilyRepo->shouldReceive('saveFamily')
                ->once()
                ->with(Mockery::on(
                        function($passedInFamilyInfo) use($familyInput)
                {
                 $this->assertNull($passedInFamilyInfo['id']);
                 $this->assertEquals($familyInput['family_name'], $passedInFamilyInfo['family_name']);
                 
                 return true;
                 
                }
                ));
                
        //Act
        $this->testController->storeFamilyWith($this->contactInput);
    }
    
    /*
     * Test that the helper method passes values into the repository methods
     */
    public function testStoreFamilyContactWithReceivesFamilyContactInfo()
    {
        //Assemble
        $familyContactInput = $this->familyContactInput[0];
        
        $this->mockedFamilyContactRepo->shouldReceive('saveFamilyContact')
                ->once()
                ->with(Mockery::on(
                        function($passedInFamilyContactInfo) use($familyContactInput)
                {
                    $this->assertNotNull($passedInContactInfo['family_id']);
                    $this->assertEquals($familyContactInput['primary'], $passedInContactInfo['primary']);
                    
                    return true;
                }
                ));
                
        //Act
        $this->testController->storeFamilyContactWith($this->familyContactInput[0]); 
    }
    
    /*
     * Purpose: Test that the store method redirects to the show page
     */
    public function OFF_testStoreRedirect()
    {
        //Assemble
        $this->mockedFamilyRepo->shouldReceive('saveFamily')->once()->with($this->testFamily);
        
        //Act
        $this->call('GET', "family/store");
        
        //Assert
        $this->assertRedirectedToRoute('family.show');
    }
    
    /*
     * Test clean up
     */
    public function tearDown()
    {
        Mockery::close();
    }
    
    
    
    
}
