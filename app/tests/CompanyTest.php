<?php

class CompanyTest extends TestCase {
    
//    public function tearDown() 
//    {
//        Mockery::close();
//        
//    }
    
    public function setUp()
    {
        parent::setUp();
        
        // Create dummy Company and Contact information
        
        $companyInput = [ 
            'company_name' => 'Test Company ABC',
            'contact_id' => '1'];
        
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
        
        // Instantiate objects with the dummy data
        $this->testCompany = new Company($companyInput);
        $this->testContact = new Contact($contactInput);
        
    }
    
    /**
     * Purpose: test the store method for successfully storing a company
     */
    public function testStoreCompanySuccess()
    {
        //Assemble the required information for the test
        $isCompany = true;
        
        //create a mock company repository to use for the test
        $mockedCompanyRepo = Mockery::mock('app\repositories\CompanyRepository');
        $this->app->instance('app/respositories/CompanyRepository', $mockedCompanyRepo);
        
        //create a mock contact repository to use for the test
        $mockedContactRepo = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app/repositories/ContactRepository', $mockedContactRepo);
        
        $testController = new ContactController($mockedCompanyRepo, $mockedContactRepo);
        
        //Act - call the method
        $this->call("POST", "contact/store");
        
        //Assert - run the tests
        $this->assertTrue($isCompany);
        $this->assertTrue(1, $this->testContact()->id);
        $this->assertTrue($this->testContact->id, $this->testCompany->contact_id);
        
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
            
                $mockCompany = Mockery::mock('CompanyRepository');
                $mockCompany->once()->andReturn('CompanyRepository');
                $this->instance('ContactController', $mockCompany);
                
                $response = $this->action('GET', 'ContactController@create');
                $this->assertTrue($response->isOk());                
	}
        
        

}
