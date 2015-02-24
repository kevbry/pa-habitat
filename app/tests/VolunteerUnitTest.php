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
        parent::setUp();
        
        
        // Create dummy Volunteer information
        $this->volunteerInput = $this->contactInput;
        
        $this->volunteerInput['is_volunteer'] = true;
        $this->volunteerInput['active_status'] = 'active';
        $this->volunteerInput['lastAttendedSafetyMeetingDate'] = 'null';
        
        $this->testVolunteer = new Volunteer($this->volunteerInput);
    }
    
    
    /**
     * Purpose: Test the store method for sucessfully storing a volunteer
     */
    public function testStoreVolunteerSuccess()
    {
        // Assemble
        //$this->mockedContactController->shouldReceive('storeVolunteerWith')->once()->with($this->volunteerInput);
        $this->mockedVolunteerRepo->shouldReceive('saveVolunteer')->once()->with(Mockery::type('Volunteer'));

        parent::testStoreContactSuccess($this->volunteerInput);
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
        $volunteerInput = $this->volunteerInput;
        
        $this->mockedVolunteerRepo->shouldReceive('saveVolunteer')
                ->once()
                ->with(Mockery::on(
                        function($passedInVolunteerInfo) use($volunteerInput)
                {
                    $this->assertNotNull($passedInVolunteerInfo['id']);
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
    public function OFF_testIndex() 
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
        Mockery::close();
    }    
}
