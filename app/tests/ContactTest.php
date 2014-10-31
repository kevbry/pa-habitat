<?php

class ContactTest extends TestCase {
    
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
        //
    }
    
    public function testShow()
    {
        $response = $this->action('GET', 'ContactController@show', array('user' => 1));
        $this->assertContains('Greg Smith',$response->getContent());
        
    }
}
