<?php
 
class UserTest extends TestCase 
{

    protected $mockedUserController;
    protected $userInput;
    protected $invalidDataException;
    protected $mockedWhatever;
    
    public function setUp()
    {
        parent::setUp();
        $this->userInput = [];
        
    }
        
    /**
     * Test that the controller can sucessfully add items to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->mockedUserController = Mockery::mock('UserController[storeUserWith]');
        $this->app->instance('UserController', $this->mockedUserController);

        $testID = mt_rand(1,100);
        $this->userInput = [
            'contact_id' => $testID, 
            'password' => 'testpassword',
            'confirm_password' => 'testpassword',
            'access_level' => 'admin'
         ];
        
        $this->mockedUserController->shouldReceive('storeUserWith')->once()->andReturn($testID);

        // Act 
        $response = $this->action("POST", "UserController@store", $this->userInput);

        // Assert
        $this->assertRedirectedToRoute('user.show',$testID);

    }
    
    public function testIndexRoute()
    {
        $this->mockedUserController = Mockery::mock('UserController[index]');
        $this->app->instance('UserController', $this->mockedUserController);
        $this->mockedUserController->shouldReceive('index')->once();
        
        $response = $this->action('GET', 'UserController@index');
        
        $this->assertResponseOk();
    } 
    
    public function testIndexResponse()
    {
        $this->mockedUser = Mockery::mock('Eloquent','User[all]');
        $this->app->instance('User', $this->mockedUser);
        
        $response = $this->action('GET', 'UserController@index');
        
        $this->assertContains('Users', $response->getContent());
    }
    
    public function testCreate()
    {
        $this->mockedUserController = Mockery::mock('UserController[create]');
        $this->app->instance('UserController', $this->mockedUserController);
        $this->mockedUserController->shouldReceive('create')->once();
        
        $response = $this->action('GET', 'UserController@create');
        
        $this->assertResponseOk();
    }
    
    public function testShowRoute()
    {
        $this->mockedUserController = Mockery::mock('UserController[show]');
        $this->app->instance('UserController', $this->mockedUserController);
        $this->mockedUserController->shouldReceive('show')->once()->with(1);
        
        $response = $this->action('GET', 'UserController@show', 1);
        
        $this->assertResponseOk();        
    }
    
    public function testShowResponse()
    {
        $this->mockedUser = Mockery::mock('Eloquent','User[find]');
        $this->app->instance('User', $this->mockedUser);
        
        $response = $this->action('GET', 'UserController@show', 82);
        
        $this->assertContains('User Details', $response->getContent());        
    }
    
    public function testEditRoute()
    {
        $this->mockedUserController = Mockery::mock('UserController[edit]');
        $this->app->instance('UserController', $this->mockedUserController);
        $this->mockedUserController->shouldReceive('edit')->once()->with(1);
        
        $response = $this->action('GET', 'UserController@edit', 1);
        
        $this->assertResponseOk();           
    }
    
    public function testEditResponseSuccessfulUpdate()
    {       
        $userInput['contact_id'] = 82;
        $userInput['access_level'] = 'basic_user';

        
        $this->mockedUserController = Mockery::mock('app\controllers\UserController');
        $this->app->instance('app\controllers\UserController', $this->mockedUserController);
        
        // Assemble
        $this->mockedUserController
                ->shouldReceive('update')->once()
                ->with($userInput['contact_id']);

        // Act 
        $this->mockedUserController->update($userInput['contact_id']);
        $this->route("PUT", "user.update", $userInput);

        //Assert
        //$this->assertRedirectedToAction("ProjectController@update",1);
        $this->assertResponseStatus(302);
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


