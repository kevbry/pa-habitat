<?php

/**
 * Description of ContactUnitTests
 *
 * @author cst222
 */
class ContactUnitTest extends TestCase
{
    protected $mockedContactRepo;
    protected $mockedVolunteerRepo;
    protected $mockedCompanyRepo;
    protected $mockedDonorRepo;
    protected $mockedContactController;
    
    protected $testController;
    
    protected $testContact;
    protected $testVolunteer;
    
    protected $contactInput;
    protected $volunteerInput;
    protected $invalidDataException;
    
    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        parent::setUp();

        // Create dummy Contact information
        $this->contactInput = [
            'id' => '555',
            'first_name' => 'Test', 
            'last_name' => 'Testerson', 
            'email_address' => 'testT@example.com',
            'home_phone' => '555-555-5555',
            'cell_phone' => '555-555-5555', 
            'work_phone' => '555-555-5555', 
            'street_address' => '123 Main St', 
            'city' => 'Saskatoon', 
            'province' => 'SK', 
            'postal_code' => 'S7H5M3', 
            'country' => 'Canada', 
            'comments' => 'Is a really ordinary person.'
         ];
        

        // Instantiate objects with dummy data
        $this->testContact = new Contact($this->contactInput);

        
        $this->mockedContactRepo = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->mockedContactRepo);

        $this->mockedCompanyRepo = Mockery::mock('app\repositories\CompanyRepository');
        $this->app->instance('app\respositories\CompanyRepository', $this->mockedCompanyRepo);
        
        $this->mockedVolunteerRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app\repositories\VolunteerRepository', $this->mockedVolunteerRepo);
        
        $this->mockedDonorRepo = Mockery::mock('app\repositories\DonorRepository');
        $this->app->instance('app\repositories\DonorRepository', $this->mockedDonorRepo);
        
        $this->mockedContactController = Mockery::mock('app\controllers\ContactController');
        $this->app->instance('app\controllers\ContactController', $this->mockedContactController);
        
        $this->testController = new ContactController($this->mockedContactRepo, $this->mockedVolunteerRepo, $this->mockedCompanyRepo, $this->mockedDonorRepo);
    }
    
    /**
     * Test that the system can sucessfully add a contact to the database
     * NOTE: as of release two, despite it seeming like this should work, it is
     *       broken.
     */
    public function testStoreContactSuccess()
    {
        // Assemble
        $this->mockedContactController->shouldReceive('storeContactWith')->once()->with($this->contactInput);
        $this->mockedContactRepo->shouldReceive('saveContact')->once()->with(Mockery::type('Contact'));

        
        Redirect::shouldReceive('action')->once()->with('ContactController@show');
        
        // Act 
        $response = $this->route("POST", "contact.store", $this->contactInput);
        //$this->testController->store();
        
        // Assert
        $this->assertTrue("first_name", $response);
        
    }

    /**
     * Test that the system can gracefully handle not successfully adding contacts
     */
    public function testStoreContactFails()
    {
        // TODO: Make sure to test when a contact fails to be added once that
        // story comes up
    }
    
    /**
     * Test that the appropriate view gets called
     */
    public function testView()
    {
        // Call the method
        $response = $this->call('GET', 'contact/create');
        
        // Make assertions -- maybe add some more stuff to assert.
        $this->assertContains('Contact', $response->getContent());
    }
    
    /**
     * Test that the appropriate view is created
     */
    public function testCreate()
    {
        $response = $this->action('GET', 'ContactController@create');
        $crawler = $this->client->request('GET', 'create');
        
        $this->assertContains('Create a Contact',$response->getContent());
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('label:contains("First Name:")'));
    }

    /**
     * Test helper method that creates a contact object and passes it to the
     * repository
     */
    public function testStoreContactWith()
    {
        // Assemble
        $this->mockedContactRepo->shouldReceive('saveContact')->once()->with(Mockery::type('Contact'));
        
        // Act
        $this->testController->storeContactWith($this->contactInput);
    }
    
    /**
     * Test that the helper method passes values into the repository methods
     */
    public function testStoreContactWithReceivesContactInfo()
    {
        // Assemble
        $contactInput = $this->contactInput;
        
        $this->mockedContactRepo->shouldReceive('saveContact')
                ->once()
                ->with(Mockery::on(
                        function($passedInContactInfo) use($contactInput)
                {
                    $this->assertNull($passedInContactInfo['id']);
                    $this->assertEquals($contactInput['last_name'], $passedInContactInfo['last_name']);
                    
                    return true;
                }
                ));
      
        // Act
        $this->testController->storeContactWith($this->contactInput);
    }
    
    /**
     * Purpose: Test that the store method redirects to the show page
     */
    public function OFF_testStoreRedirect()
    {

        $this->mockedContactRepo->shouldReceive('saveContact')->once()->with($this->testContact);

        // Act    
        $this->call("GET", "contact/store");
        
        // Assert
        $this->assertRedirectedToRoute('contact.show');
    }
  
    /**
     * Test clean up
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
