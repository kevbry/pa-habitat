<?php

/**
 * Unit tests for the Contact Controller class
 */
class DonorUnitTest extends ContactUnitTest {
    
    public $donorInput;
    protected $mockedDonorRepo;
    protected $testDonor;
    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        parent::setUp();
        
        $this->donorInput = $this->contactInput;
        
        $this->donorInput['is_donor'] = true;

    }
    
    /**
     * Purpose: Test the store method for sucessfully storing a volunteer
     */
    public function testStoreDonorSuccess()
    {
        // Assemble
        
        //$this->mockedContactController->shouldReceive('storeDonorWith')->once()->with($this->donorInput);
        $this->mockedDonorRepo->shouldReceive('saveDonor')->once()->with(Mockery::type('Donor'));
        
        // Act 
        parent::testStoreContactSuccess($this->donorInput);
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
     * Test that the helper method passes values into the repository methods
     */
    public function testStoreDonorWithReceivesDonorInfo()
    {
        // Assemble
        $donorInput = $this->donorInput;

        $this->mockedDonorRepo->shouldReceive('saveDonor')
                ->once()
                ->with(Mockery::on(
                        function($passedInDonorInfo) use($donorInput)
                        {
                            //$this->assertAttributeContains(true, 'is_donor', $passedInDonorInfo);
                            $this->assertEquals($donorInput['is_donor'], $passedInDonorInfo['is_donor']);
                            
                            return true;
                        }
                        ));
      
        // Act
        $this->testController->storeDonorWith($this->donorInput);
    }
    
    /** 
    * Function for cleaning up after tests are complete
    */
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
}