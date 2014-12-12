<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of VolunteerTest
 *
 * @author cst222
 */
class VolunteerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        // Create dummy Volunteer information
        $volunteerInput = [
            'id' => '555',
            'active_status' => '1', 
            'last_attended_safety_meeting_date' => '2014-12-03'
         ];
        
        
        // Instantiate objects with dummy data
        $this->testVolunteer = new Volunteer($volunteerInput);
        
    }
    
    
    public function testIndex() 
    {
        $response = $this->call('GET', 'volunteer');
        $this->assertContains('Volunteers',$response->getContent());
        $crawler = $this->client->request('GET', 'volunteer');
        $this->assertTrue($this->client->getResponse()->isOk());
    }
    /**
     * Purpose: Test the functionality of the store method
     */
    public function testVolunteerStore()
    {
        // Assemble - Get everything ready
    
    
        // Act - Call the method
    
    
        // Assert - Make assertions
    }
    
    /**
     * Purpose: Test the functionality of the create method
     */
    public function testVolunteerCreate()
    {
        // Assemble - Get everything ready
    
    
        // Act - Call the method
    
    
        // Assert - Make assertions         
    }
    
        /** 
     * Function for cleaning up after tests ar complete
     */
    public function tearDown()
    {
        Mockery::close();
    }

    
    
}
