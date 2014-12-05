<?php

class DonorIntegrationTest extends TestCase {
    
    
    public function testIndex() 
    {

    }
    
    public function testCreate() 
    {
        $response = $this->call('GET', 'donor/create');
        $this->assertContains('Create a Donor',$response->getContent());
        $crawler = $this->client->request('GET', 'create');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('label:contains("Business Name:")'));
    }
    
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

        
    }
    
    public function testShow()
    {
        
    }
}