<?php

/**
 * Unit tests for the Contact Controller class
 */
class VolunteerUnitTest extends ContactUnitTest {
 
    var $volunteerInput;
    var $testVolunteer;
    var $mockedVolunteerRepo;
    
    public function setUp()
    {
        // Create dummy Volunteer information
        $this->volunteerInput = [
            'active_status' => 'active',
            'lastAttendedSafetyMeetingDate' => 'null'
        ];
        
        $this->testVolunteer = new Volunteer($this->volunteerInput);
        
        $this->mockedVolunteerRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app\repositories\VolunteerRepository', $this->mockedVolunteerRepo);
        
        
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
     * Test that the helper method passes the appropriate object
     */
    public function testStoreVolunteerWith()
    {
        // Assemble
        $this->mockedVolunteerRepo->shouldReceive('saveVolunteer')->once()->with(Mockery::type('Volunteer'));
     
        // Act
        $this->testController->storeVolunteerWith($this->volunteerInput);
    }
    
    /**
     * Test that the helper method passes values into the repository methods
     */
    public function testStoreVolunteerWithReceivesVolunteerInfo()
    {
        // Assemble
        $contactInput = $this->contactInput;
        
        $this->mockedVolunteerRepo->shouldReceive('saveVolunteer')
                ->once()
                ->with(Mockery::on(
                        function($passedInContactInfo) use($volunteerInput)
                {
                    $this->assertNull($passedInVolunteerInfo['id']);
                    $this->assertEquals($volunteerInput['active_status'], $passedInVolunteerInfo['active_status']);
                    
                    return true;
                }
                ));
      
        // Act
        $this->testController->storeVolunteerWith($this->volunteerInput);
    }
    
    /**
     * Test view all volunteers
     */
    public function testIndex() 
    {
        $response = $this->call('GET', 'volunteer');
        $this->assertContains('Contacts',$response->getContent());
        $crawler = $this->client->request('GET', 'volunteer');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('td:contains("Volunteer")'));
    }
    
    /** 
     * Function for cleaning up after tests are complete
     */
    public function tearDown()
    {
        parent::tearDown();
    }
}
