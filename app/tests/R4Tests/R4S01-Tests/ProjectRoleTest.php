<?php
 
class ProjectRoleTest extends TestCase 
{

    protected $mockedProjectContactController;
    protected $mockedProjectContactRepository;
    protected $projectContactInput;
    protected $invalidDataException;
    
    public function setUp()
    {
        parent::setUp();
        $this->projectContactInput = [];
        
    }
        
    /**
     * Test that the controller can sucessfully add items to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->mockedProjectContactController = Mockery::mock('ProjectContactController[storeContactWith]');
        $this->app->instance('ProjectContactController', $this->mockedProjectContactController);

        $this->projectContactInput = [
            'project_id' => 2,
            'contact_id' => 1,
            'notes' => 'Batteries not included',
            'role_id' => 1
         ];
        
        $this->mockedProjectContactController->shouldReceive('storeContactWith')->once()->andReturn(1);

        // Act 
        $response = $this->action("POST", "ProjectContactController@store", $this->projectContactInput);

        // Assert
        $this->assertRedirectedToAction('ProjectContactController@index',2);

    }
    
    public function testIndexRoute()
    {
        $this->mockedProjectContactController = Mockery::mock('ProjectContactController[index]');
        $this->app->instance('ProjectContactController', $this->mockedProjectContactController);
        $this->mockedProjectContactController->shouldReceive('index')->once();
        
        $response = $this->action('GET', 'ProjectContactController@index');
        
        $this->assertResponseOk();
    } 
    
    public function OFF_testIndexResponse()
    {
        $this->mockedUser = Mockery::mock('Eloquent','User[all]');
        $this->app->instance('User', $this->mockedUser);
        
        $response = $this->action('GET', 'UserController@index');
        
        $this->assertContains('Users', $response->getContent());
    }
    
    public function OFF_testCreate()
    {
        $this->mockedUserController = Mockery::mock('UserController[create]');
        $this->app->instance('UserController', $this->mockedUserController);
        $this->mockedUserController->shouldReceive('create')->once();
        
        $response = $this->action('GET', 'UserController@create');
        
        $this->assertResponseOk();
    }
    
    public function OFF_testShowRoute()
    {
        $this->mockedUserController = Mockery::mock('UserController[show]');
        $this->app->instance('UserController', $this->mockedUserController);
        $this->mockedUserController->shouldReceive('show')->once()->with(1);
        
        $response = $this->action('GET', 'UserController@show', 1);
        
        $this->assertResponseOk();        
    }
    
    public function OFF_testShowResponse()
    {
        $this->mockedUser = Mockery::mock('Eloquent','User[find]');
        $this->app->instance('User', $this->mockedUser);
        
        $response = $this->action('GET', 'UserController@show', 82);
        
        $this->assertContains('User Details', $response->getContent());        
    }
    
    /*
     * Test clean up
     */
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
    
}


