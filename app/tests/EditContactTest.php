<?php
/**
 * Description of ContactUnitTests
 *
 * @author cst222
 */
class EditContactTest extends TestCase
{
    protected $mockedContactRepo;
    protected $mockedContactController;
    
    protected $contactInput;
    protected $invalidDataException;
    
    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        parent::setUp();

        // Create dummy Contact information
        $this->contactInput = [
            'id' => '555',
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
        

        // Instantiate objects with dummy data

        $this->mockedContactRepo = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->mockedContactRepo);
        
        $this->mockedContactController = Mockery::mock('app\controllers\ContactController');
        $this->app->instance('app\controllers\ContactController', $this->mockedContactController);
    }
    /**
     * Test that the controller can sucessfully edit a contact
     */
    public function testStoreEditSuccess()
    {
        // Assemble
        $this->mockedContactController
                ->shouldReceive('update')->once()
                ->with($this->contactInput['id']);
        /*$this->mockedContactRepo->shouldReceive('getContact')
                ->once()->with($this->contactInput);*/
                //->andThrow($this->invalidDataException);

        // Act 
        $this->mockedContactController->update($this->contactInput['id']);
        $this->route("PUT", "contact.update", $this->contactInput);

        //Assert
        $this->assertResponseStatus(302);
        //$this->assertRedirectedTo('contact/555');
    }
    
    public function testStoreEditFailure()
    {
        //This function will redirect back to the edit page, due to
        //the information being passed not validating
        $this->contactInput = ['id'=>555];
        
        // Assemble
        $this->mockedContactController
                ->shouldReceive('update')->once()
                ->with($this->contactInput['id']);
        /*$this->mockedContactRepo->shouldReceive('getContact')
                ->once()->with($this->contactInput);*/
                //->andThrow($this->invalidDataException);

        // Act 
        $this->mockedContactController->update($this->contactInput['id']);
        $this->route("PUT", "contact.update", $this->contactInput);

        //Assert
        //$this->assertResponseOk();
        $this->assertRedirectedTo('contact/555/edit');
    }
    /* TODO: Find out how to test "GET" form methods
    public function testShowToEditRedirectSuccess()
    {
        //Assemble
        $this->mockedContactController
                ->shouldReceive('edit')
                ->once()
                ->with($this->contactInput['id']);
        $this->mockedContactRepo->shouldReceive('getContact')
                ->once()->with($this->contactInput['id']);
        
        //Act
        //$this->mockedContactController->edit($this->contactInput['id']);
        //$this->call("GET", "contact/555/edit",$this->contactInput);
        
        //Assert
        $this->assertRedirectedTo('contact/555/edit');
    }
    public function testShowToEditRedirectFailure()
    {
        //Assemble
        $this->mockedContactController
                ->shouldReceive('edit')
                ->once()
                ->with($this->contactInput['id']);
        $this->mockedContactRepo->shouldReceive('getContact')
                ->once()->with($this->contactInput['id']);
               // ->andThrow($this->invalidDataException);
        //Redirect::shouldReceive('action')->once()->with('ContactController@edit');
        //Act
        //$this->mockedContactController->edit($this->contactInput['id']);
        //$this->route("PUT", "contact.edit",$this->contactInput['id']);
        

                
        // Act    
        //$this->call("GET", "contact/edit");
        
        // Assert
        $this->assertRedirectedTo('contact/555/edit');
    }*/

    /**
     * Test clean up
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
