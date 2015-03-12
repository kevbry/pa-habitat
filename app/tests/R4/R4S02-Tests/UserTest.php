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

        $this->mockedUserController = Mockery::mock('app\controllers\UserController');
        $this->app->instance('app\controllers\UserController', $this->mockedUserController);
        
    }
        
    /**
     * Test that the controller can sucessfully add items to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->mockedWhatever = Mockery::mock('Eloquent', 'User');
        
        $this->userInput = [
            'id' => '555',
            'contact_id' => rand(1,100), 
            'password' => 'testpassword',
            'confirm_password' => 'testpassword',
            'access_level' => 'admin'
         ];
        
        $this->mockedWhatever->shouldReceive('create')->once();
        
        $this->app->instance('User', $this->mockedWhatever);
        
        // Assemble
        //$this->mockedUserController->shouldReceive('create')->once();
        

        // Act 
        $response = $this->call("POST", "user", $this->userInput);

        // Assert
        $this->assertContains("ADDED", $response->getContent());
        //$this->assertRedirectedToAction('UserController@show',2);
    }
    
    public function testIndex()
    {
        $this->mockedUserController->shouldReceive('index')->once();
        
        $response = $this->action('GET', 'UserController@index');
        
        $view = $response->original;
        
        $this->assertResponseOk();
        $this->assertArrayHasKey('users',$view);
        
    } 
    
    public function testCreate()
    {
        //Call the method
        $response = $this->call('GET', 'user/create');
        
        //Make assertions
        $this->assertContains('Create User', $response->getContent());
        $this->assertTrue($this->client->getResponse()->isOk());
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


