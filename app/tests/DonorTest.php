<?php

class DonorTest extends TestCase {
    
    /*
    public function testIndex() 
    {
        $response = $this->call('GET', 'donor');
        $this->assertContains('Donors',$response->getContent());
        $crawler = $this->client->request('GET', 'donor');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('td:contains("Greg Smith")'));
    }*/
    
    public function testCreate() 
    {
        $response = $this->call('GET', 'donor/create');
        $this->assertContains('Create a Donor',$response->getContent());
        $crawler = $this->client->request('GET', 'create');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('label:contains("Business Name:")'));
    }
    /*
    public function testStore() 
    {
        // Reset and Refresh database (MAYBE TRY TO DO THIS BETTER NEXT TIME)
        Artisan::call('migrate:reset');
        Artisan::call('migrate:refresh');
        
        // Reseed database
        $this->seed();
        
        // Create dummy contact to add
        $input = [
                'business_name' => 'Test'
                 ];
        
        // Act
        $response = $this->action('POST', 'DonorController@store', $input);
        
        // Assert
        $this->assertRedirectedTo('/donor/1');

        
    }*/
    /*
    public function testShow()
    {
        $response = $this->action('GET', 'DonorController@show', array('user' => 1));
        $this->assertContains('Test',$response->getContent());
        
    }*/
}
