<?php

/**
 * Unit tests for the Contact Controller class
 */
class VolunteerUnitTests extends ContactUnitTests {
 
    public function setUp()
    {
        // Create dummy Volunteer information
        $this->volunteerInput = [
            'active_status' => 'active',
            'lastAttendedSafetyMeetingDate' => 'null'
        ];
        
        $this->testVolunteer = new Volunteer($this->volunteerInput);
        
        $this->mockedVolunteerRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app/repositories/VolunteerRepository', $this->mockedVolunteerRepo);
        
        
        parent::setUp();
    }
    
    
    /**
     * Purpose: Test the store method for sucessfully storing a volunteer
     */
    public function testStoreVolunteerSuccess()
    {
        // Assemble
        $isVolunteer = true;

        $this->mockedVolunteerRepo->shouldReceive('saveVolunteer')->once()->with(Mockery::type('Volunteer'));
        
        $this->mockedContactController->shouldReceive('storeVolunteerWith')->once()->with($this->volunteerInput);
        
        parent::testStoreContactSuccess();
    }
    
    public function testStoreVolunteerFails()
    {
        parent::testStoreContactFails();
    }
    
    /**
     * 
     */
    public function testStoreVolunteerWith()
    {
        // Assemble
        $this->mockedVolunteerRepo->shouldReceive('saveVolunteer')->once()->with(Mockery::type('Volunteer'));
     
        // Act
        $this->testController->storeVolunteerWith($this->volunteerInput);
    }
    
//    
//    
//    /**
//     * Purpose: Test coverage for if the system fails to add a contact before the volunteer
//     * @expectedException ApplicationException
//     */
//    public function testStoreVolunteerFails()
//    {
//        // Assemble
//        $isVolunteer = true;
//
//        
////        $this-> = Mockery::mock('app\repositories\VolunteerRepository');
////        $this->app->instance('app/repositories/VolunteerRepository', $mockedRepo);
//        
//        //$testController = new ContactController($mockedRepo);
//
//        // Act    
//        $this->mockedVolunteerRepo->shouldReceive('saveContact')->once()->with(null);
//        $this->mockedVolunteerRepo->shouldReceive('saveVolunteer')->once()->with($this->testVolunteer);
//        
//        // Assert
//    }
//    
//    /**
//     * Test creating a view, ensuring that the volunteer fields exist
//     */
//    public function testCreateVolunteerView()
//    {
//        // Call the method
//        $response = $this->call('GET', 'contact/create');
//        
//        // Make assertions
//        $this->assertContains('Volunteer', $response->getContent());
//    }
//    
    
    /** 
     * Function for cleaning up after tests ar complete
     */
    public function tearDown()
    {
        parent::tearDown();
    }
}
