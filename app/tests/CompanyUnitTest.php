<?php

class CompanyUnitTest extends ContactUnitTest 
{
    protected $companyInput;
    protected $testCompany;
    protected $mockedCompanyRepo;
    
    
    public function setUp()
    {
        parent::setUp();

        // Create dummy Company and Contact information
        $this->companyInput = $this->contactInput;
        
        $this->companyInput['name'] = 'Test Company ABC';
        $this->companyInput['contact_id'] = '555';
        
    }
    
    /**
     * Purpose: test the store method for successfully storing a company
     */
    public function OFF_testStoreCompanySuccess()
    {        
        //$this->mockedContactController->shouldReceive('storeCompanyWith')->once()->with($this->companyInput);
        $this->mockedCompanyRepo->shouldReceive('saveCompany')->once()->with(Mockery::type('Company'));

        //Assert - run the tests
        parent::testStoreContactSuccess($this->companyInput);
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
        $this->testController->storeCompanyWith($this->companyInput);        
    }
    
    /**
     * Test that the helper method passes values into the repository methods
     */
    public function testStoreCompanyWithReceivesCompanyInfo()
    {
        // Assemble
        $companyInput = $this->companyInput;
        
        $this->mockedCompanyRepo->shouldReceive('saveCompany')
                ->once()
                ->with(Mockery::on(
                        function($passedInCompanyInfo) use($companyInput)
                {
                    $this->assertNull($passedInCompanyInfo['id']);
                    $this->assertEquals($companyInput['name'], $passedInCompanyInfo['name']);
                    $this->assertEquals($companyInput['contact_id'], $passedInCompanyInfo['contact_id']);
                    
                    return true;
                }
                ));
      
        // Act
        $this->testController->storeCompanyWith($this->companyInput);
    }
    
    
    /**
     * Test view all companies
     */
    public function OFF_testIndex() 
    {
        $response = $this->call('GET', 'company');
        $this->assertContains('Company',$response->getContent());
        $crawler = $this->client->request('GET', 'company');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('td:contains("Company")'));
    }
    
    
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
    

}
