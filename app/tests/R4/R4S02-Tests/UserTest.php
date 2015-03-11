<?php
 
class UserTest extends TestCase 
{

    protected $mockedUserController;
    protected $userInput;
    protected $invalidDataException;
    
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
        $this->userInput = [
            'id' => '555',
            'contact_id' => 2, 
            'email_username' => 'etter1596@siast.sk.ca',
            'password' => '',
            'access_level' => 'admin'
         ];
        
        // Assemble
        $this->mockedUserController->shouldReceive('store')->once();

        // Act 
        $response = $this->route("POST", "storeUser", $this->userInput);

        // Assert
        $this->assertRedirectedToAction('UserController@show',2);
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


