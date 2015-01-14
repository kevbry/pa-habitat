<?php

class ContactIntegrationTests extends TestCase {
    
    
    public function testIndex() 
    {
        $response = $this->call('GET', 'contact');
        $this->assertContains('Contacts',$response->getContent());
        $crawler = $this->client->request('GET', 'contact');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('td:contains("Greg Smith")'));
    }
    
    public function testCreate() 
    {
        $response = $this->call('GET', 'contact/create');
        $this->assertContains('Create a Contact',$response->getContent());
        $crawler = $this->client->request('GET', 'create');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('label:contains("First Name:")'));
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
        
        // Act
        $response = $this->action('POST', 'ContactController@store', $input);
        
        // Assert
        $this->assertRedirectedTo('/contact/5');

        
    }
    
    public function testShow()
    {
        $response = $this->action('GET', 'ContactController@show', array('user' => 1));
        $this->assertContains('Greg Smith',$response->getContent());
        
    }
}
