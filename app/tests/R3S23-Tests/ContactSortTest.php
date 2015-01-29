<?php
 
class ContactSortTest extends TestCase 
{
    protected $mockedContactRepo;
    protected $mockedContactController;
    protected $contactInput;
    
    
    public function setUp()
    {
        parent::setUp();
        //TODO - Populate array with a dummy entry for the volunteerhours table
        $this->contactInput = [];

        // Set up the Volunteer Hours Mocked Repository
        $this->mockedContactRepo = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->mockedContactRepo);
        
        $this->mockedContactController = Mockery::mock('app\controllers\ContactController');
        $this->app->instance('app\controllers\ContactController', $this->mockedContactController);
        
    }
    


     public function testIndexForContact()
    {
         $this->mockedContactRepo->shouldReceive('getAllContacts');
        $this->mockedContactRepo
                ->shouldReceive('orderBy')->once()->with(array('f','a'));
        
        $this->app->instance('app\repositories\ContactRepository', $this->mockedContactRepo);
        
        $this->call('GET','contact');
        
        $this->assertResponseOk();
        
    }
    
}


