<?php

class CompanyTest extends TestCase {
    
    public function tearDown() 
    {
        Mockery::close();
        
    }

	/**
	 * A basic functional test example.
	 *
	 * @return void
	 */
	public function testCreate()
	{
		//$crawler = $this->client->request('GET', '/');

		//$this->assertTrue($this->client->getResponse()->isOk());
            
                $mockCompany = Mockery::mock('company');
                $mockCompany->once()->andReturn('company');
                $this->instance('CompanyController', $mockCompany);
                
                $response = $this->action('GET', 'CompanyController@create');
                $this->assertTrue($response->isOk());                
	}
        
        

}
