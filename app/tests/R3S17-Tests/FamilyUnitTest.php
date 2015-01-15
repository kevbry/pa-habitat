<?php

/**
 * Description of FamilyUnitTest
 *
 * @author cst220
 */
class FamilyUnitTest extends TestCase
{
    
    protected $mockedFamilyRepo;
    protected $mockedFamilyContactRepo;
    protected $mockedFamilyController;
    
    protected $testController;
    
    protected $familyInput;
    protected $familyContactInput;
    
    /*
     * Set up the function for the tests. Creates dummy objects to use for Testing.
     */
    public function setUp() 
    {
        parent::setUp();
        
        //Create dummy Family information
        $this->familyInput = [
            'name' => 'Johnson',
            'status' => 'pending',
            'comments' => 'next on the list for a house.'
        ];
        
        //Create dummy FamilyContact information
        $this->familyContactInput = [
            'family_id' => '002',
            'contact_id' => '065',
            'primary' => 'true',
            'currently_active' => 'true'
        ];
        
        // Instantiate mocked objects with dummy data
        $this->mockedFamilyRepo = Mockery::mock('app\repositories\FamilyRepository');
        $this->app->instance('app\repositories\FamilyRepository', $this->mockedFamilyRepo);
        
        $this->mockedFamilyContactRepo = Mockery::mock('app\repositories\FamilyContactRepository');
        $this->app->instance('app\repositories\FamilyContactRepository', $this->mockedFamilyContactRepo);
        
        $this->testController = new FamliyController($this->mockedFamilyRepo, $this->mockedFamilyContactRepo);
        
    }
    
    /*
     * Test that the system can successfully add a family to the database
     */
    public function testStoreFamilySuccess()
    {
        //Assemble
        $this->mockedFamilyController->shouldReceive('storeFamilyWith')->once()->with($this->familyInput);
        $this->mockedFamilyRepo->shouldReceive('saveFamily')->once()->with(Mockery::type('Family'));
        
        Redirect::shouldReceive('action')->once()->with('FamilyController@show');
        
        //Act
        $response = $this->route("POST", "family.store", $this->familyInput);
        
        //Assert
        $this->assertTrue("name", $response);
    }
    
    
    
}
