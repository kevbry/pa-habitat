<?php

/**
 * Unit tests for the Contact Controller class
 */
class DonorUnitTests extends TestCase {
    
    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        parent::setUp();

        // Create dummy Contact information
        $contactInput = [
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
        
        // Create dummy Donor information
        $donorInput = [
            'business_name' => 'Test Business',
        ];
        
        // Instantiate objects with dummy data
        $this->testContact = new Contact($contactInput);
        $this->testDonor = new Donor($donorInput);
        
    }
    
    /**
     * Purpose: Test the store method for sucessfully storing a donor
     */
    public function testStoreDonorSuccess()
    {
        // Assemble
        $isDonor = true;

        $mockedRepo = Mockery::mock('app\repositories\DonorRepository');
        $this->app->instance('app/repositories/DonorRepository', $mockedRepo);
        
        $mockedRepo->shouldReceive('saveContact')->once()->with($this->testContact);
        $mockedRepo->shouldReceive('saveDonor')->once()->with($this->testDonor);
        
        $testController = new ContactController($mockedRepo);

        // Act    
        $this->call("POST", "contact/store");
        
        // Assert
        $this->assertTrue($isDonor);
        $this->assertTrue(1, $this->testContact->id);
        $this->assertTrue($this->testContact->id, $this->testDonor->contact_id);

    }
    
    /**
     * Purpose: Test that the store method redirects to the show page
     */
    public function testStoreRedirect()
    {
        $mockedRepo = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app/repositories/ContactRepository', $mockedRepo);
        
        $mockedRepo->shouldReceive('saveContact')->once()->with($this->testContact);
        
        $testController = new ContactController($mockedRepo);

        // Act    
        $this->call("POST", "contact/store");
        
        // Assert
        $this->assertRedirectedToRoute('donor.show');
    }
    
    
    /**
     * Purpose: Test coverage for if the system fails to add a contact before the donor
     * @expectedException ApplicationException
     */
    public function testStoreDonorFails()
    {
        // Assemble
        $isDonor = true;

        
        $mockedRepo = Mockery::mock('app\repositories\DonorRepository');
        $this->app->instance('app/repositories/DonorRepository', $mockedRepo);
        
        $testController = new ContactController($mockedRepo);

        // Act    
        $mockedRepo->shouldReceive('saveContact')->once()->with(null);
        $mockedRepo->shouldReceive('saveDonor')->once()->with($this->testDonor);
        
        // Assert
    }
    
    /**
     * Test creating a view, ensuring that the donor fields exist
     */
    public function testCreateDonorView()
    {
        // Call the method
        $response = $this->call('GET', 'contact/create');
        
        // Make assertions
        $this->assertContains('Donor', $response->getContent());
    }
    
    
    /** 
     * Function for cleaning up after tests ar complete
     */
    public function tearDown()
    {
        Mockery::close();
    }
}