<?php

/**
 * Unit tests for the Contact Controller class
 */
class ContactUnitTests extends TestCase {
    
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
        
        // Create dummy Volunteer information
        $volunteerInput = [
            'active_status' => 'active',
            'lastAttendedSafetyMeetingDate' => 'null'
        ];
        $donorInput = [
            'business_name' => 'Test Business'  
        ];
        
        // Instantiate objects with dummy data
        $this->testContact = new Contact($contactInput);
        $this->testVolunteer = new Volunteer($volunteerInput);
        $this->testDonor = new Donor($donorInput);
        
    }
    
    /**
     * Purpose: Test the store method for sucessfully storing a volunteer
     */
    public function testStoreVolunteerSuccess()
    {
        // Assemble
        $isVolunteer = true;

        $mockedRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app/repositories/VolunteerRepository', $mockedRepo);
        
        $mockedRepo->shouldReceive('saveContact')->once()->with($this->testContact);
        $mockedRepo->shouldReceive('saveVolunteer')->once()->with($this->testVolunteer);
        
        $testController = new ContactController($mockedRepo);

        // Act    
        $this->call("POST", "contact/store");
        
        // Assert
        $this->assertTrue($isVolunteer);
        $this->assertTrue(1, $this->testContact->id);
        $this->assertTrue($this->testContact->id, $this->testVolunteer->contact_id);

    }
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
        $this->assertRedirectedToRoute('contact.show');
    }
    
    
    /**
     * Purpose: Test coverage for if the system fails to add a contact before the volunteer
     * @expectedException ApplicationException
     */
    public function testStoreVolunteerFails()
    {
        // Assemble
        $isVolunteer = true;

        
        $mockedRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app/repositories/VolunteerRepository', $mockedRepo);
        
        $testController = new ContactController($mockedRepo);

        // Act    
        $mockedRepo->shouldReceive('saveContact')->once()->with(null);
        $mockedRepo->shouldReceive('saveVolunteer')->once()->with($this->testVolunteer);
        
        // Assert
    }
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
     * Test creating a view, ensuring that the volunteer fields exist
     */
    public function testCreateVolunteerView()
    {
        // Call the method
        $response = $this->call('GET', 'contact/create');
        
        // Make assertions
        $this->assertContains('Volunteer', $response->getContent());
    }
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