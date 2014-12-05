<?php

/**
 * Unit tests for the Contact Controller class
 */
class DonorUnitTests extends ContactUnitTests {
    
    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        $this->donorInfo['id'] = 555;
        
        $this->mockedDonorRepo = Mockery::mock('app\repositories\DonorRepository');
        $this->app->instance('app/repositories/DonorRepository', $this->mockedDonorRepo);

        $this->testDonor = new Donor($donorInfo);
        
        parent::setUp();
    }
    
    /**
     * Purpose: Test the store method for sucessfully storing a volunteer
     */
    public function testStoreDonorSuccess()
    {
        // Assemble
        $isVolunteer = true;

        $this->mockedDonorRepo->shouldReceive('saveDonor')->once()->with($this->testDonor);
        $this->mockedContactController->shouldReceive('storeDonorWith')->once()->with($this->donorInput);
        

        parent::testStoreContactSuccess();
    }

    public function testStoreDonorFails()
    {
        parent::testStoreContactFails();
    }
    

    public function testStoreDonorWith()
    {
        // Assemble
        $this->mockedDonorRepo->shouldReceive('saveDonor')->once()->with(Mockery::type('Donor'));
     
        // Act
        $this->testController->storeDonorWith($this->donorInput);       
    }
    
    /** 
    * Function for cleaning up after tests ar complete
    */
    public function tearDown()
    {
        parent::tearDown();
    }
}