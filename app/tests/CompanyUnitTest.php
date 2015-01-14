<?php

class CompanyUnitTest extends ContactUnitTest 
{
    var $companyInput;
    var $testCompany;
    var $mockedCompanyRepo;
    
    
    public function setUp()
    {
        parent::setUp();

        // Create dummy Company and Contact information
        $this->companyInput = [ 
            'company_name' => 'Test Company ABC',
            'contact_id' => '1'];
        
        // Instantiate objects with the dummy data
        $this->testCompany = new Company($this->companyInput);
        
        $this->mockedCompanyRepo = Mockery::mock('app\repositories\CompanyRepository');
        $this->app->instance('app\respositories\CompanyRepository', $this->mockedCompanyRepo);

    }
    
    /**
     * Purpose: test the store method for successfully storing a company
     */
    public function testStoreCompanySuccess()
    {
        //Assemble the required information for the test
        $isCompany = true;

        $this->mockedCompanyRepo->shouldReceive('saveCompany')->once()->with(Mockery::type('Company'));
        $this->mockedContactController->shouldReceive('storeCompanyWith')->once()->with($this->companyInput);
        
        //Act - call the method
        $this->call("POST", "contact/store");
        
        //Assert - run the tests
        parent::testStoreContactSuccess();
    }
    
    public function testStoreCompanyFails()
    {
        parent::testStoreContactFails();
    }
    
    public function testStoreCompanyWith()
    {
        // Assemble
        $this->mockedCompanyRepo->shouldReceive('saveCompany')->once()->with(Mockery::type('Company'));
     
        // Act
        $this->testController->storeCompanyWith($this->CompanyInput);        
    }
    
    /**
     * Test that the helper method passes values into the repository methods
     */
    public function testStoreCompanyWithReceivesCompanyInfo()
    {
        // Assemble
        $companyInput = $this->companyInput;
        
        $this->mockedVolunteerRepo->shouldReceive('saveCompany')
                ->once()
                ->with(Mockery::on(
                        function($passedInCompanyInfo) use($companyInput)
                {
                    $this->assertNull($passedInCompanyInfo['id']);
                    $this->assertEquals($companyInput['company_name'], $passedInCompanyInfo['company_name']);
                    
                    return true;
                }
                ));
      
        // Act
        $this->testController->storeCompanyWith($this->companyInput);
    }
    
    
    /**
     * Test view all companies
     */
    public function testIndex() 
    {
        $response = $this->call('GET', 'company');
        $this->assertContains('Contacts',$response->getContent());
        $crawler = $this->client->request('GET', 'company');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('td:contains("Company")'));
    }
    
    public function tearDown()
    {
        parent::tearDown();
    }
    

}
