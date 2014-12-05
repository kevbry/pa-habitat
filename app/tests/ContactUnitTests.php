<?php

/**
 * Description of ContactUnitTests
 *
 * @author cst222
 */
class ContactUnitTests  extends TestCase
{
    var $mockedContactRepo;
    var $mockedVolunteerRepo;
    var $mockedCompanyRepo;
    var $mockedDonorRepo;
    var $mockedContactController;
    
    var $testController;
    
    var $testContact;
    var $testVolunteer;
    
    var $contactInput;
    var $volunteerInput;
    
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
        $this->app->instance('app/repositories/ContactRepository', $this->mockedContactRepo);
        
        
        $this->mockedCompanyRepo = Mockery::mock('app\repositories\CompanyRepository');
        $this->app->instance('app/respositories/CompanyRepository', $this->mockedCompanyRepo);
        
        $this->mockedDonorRepo = Mockery::mock('app\repositories\DonorRepository');
        $this->app->instance('app/repositories/DonorRepository', $this->mockedDonorRepo);
        
        $this->mockedContactController = Mockery::mock('app\controllers\ContactController');
        $this->app->instance('app/controllers/ContactController', $this->mockedContactController);
        
        $this->testController = new ContactController($this->mockedContactRepo, $this->mockedVolunteerRepo, $this->mockedCompanyRepo, $this->mockedDonorRepo);
    }
    
    public function testStoreContactSuccess()
    {
        // Assemble
        $this->mockedContactRepo->shouldReceive('saveContact')->once()->with(Mockery::type('Contact'));
        
        $this->mockedContactController->shouldReceive('storeContactWith')->once()->with($this->contactInput)->andReturn('555');
        
        // Act 
        //$this->action("GET", "ContactController@store");
        //$testController->store();
        
        // Assert

    }

    public function testStoreContactFails()
    {
        // TODO: Make sure to test when a contact fails to be added
    }
    
    public function testView()
    {
        // Call the method
        $response = $this->call('GET', 'contact/create');
        
        // Make assertions -- maybe add some more stuff to assert.
        $this->assertContains('Contact', $response->getContent());
    }
    
    public function testCreate()
    {
        $response = $this->action('GET', 'ContactController@create');
        $crawler = $this->client->request('GET', 'create');
        
        $this->assertContains('Create a Contact',$response->getContent());
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('label:contains("First Name:")'));
    }
    
    public function testStoreContactWith()
    {
        // Assemble
        $this->mockedContactRepo->shouldReceive('saveContact')->once()->with(Mockery::type('Contact'));
      
        // Act
        $this->testController->storeContactWith($this->contactInput);
    }
    
    /**
     * Purpose: Test that the store method redirects to the show page
     */
    public function testStoreRedirect()
    {

        $this->mockedContactRepo->shouldReceive('saveContact')->once()->with($this->testContact);

        // Act    
        $this->call("GET", "contact/store");
        
        // Assert
        $this->assertRedirectedToRoute('contact.show');
    }
    
    public function tearDown()
    {
        Mockery::close();
    }
}
