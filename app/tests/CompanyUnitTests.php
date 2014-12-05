<?php

class CompanyUnitTests extends ContactUnitTests 
{
    
    public function setUp()
    {
        // Create dummy Company and Contact information
        $companyInput = [ 
            'company_name' => 'Test Company ABC',
            'contact_id' => '1'];
        
        // Instantiate objects with the dummy data
        $this->testCompany = new Company($companyInput);
        
        $mockedCompanyRepo = Mockery::mock('app\repositories\CompanyRepository');
        $this->app->instance('app/respositories/CompanyRepository', $mockedCompanyRepo);

        parent::setUp();
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
    
    
    
    public function tearDown()
    {
        parent::tearDown();
    }
    

}
