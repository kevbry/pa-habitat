<?php

class DonorAuthorizationTest extends TestCase
{
    
    private $inactiveUser;
    private $basicUser;
    private $contactManager;
    private $projectManager;
    private $administrator;
    
    public function setUp() 
    {
        parent::setUp();
        Route::enableFilters();

        $this->inactiveUser = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '1000000', 'access_level' => 'inactive'));
        $this->basicUser = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '2000000', 'access_level' => 'basic_user'));
        $this->contactManager = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '3000000', 'access_level' => 'contact_manager'));
        $this->projectManager = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '4000000', 'access_level' => 'project_manager'));
        $this->administrator = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '5000000', 'access_level' => 'administrator'));
        
    }
    
    // Test to test failed authorization for donor.index
    public function testDonorIndexFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('GET', 'donor');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for donor.index
    public function testDonorIndexSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'donor');
        
        $this->assertContains('Donors', $response->getContent());
    }
    // Test to test successful authorization for donor.index
    public function testDonorIndexSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'donor');
        
        $this->assertContains('Donors', $response->getContent());
    }
    // Test to test successful authorization for donor.index
    public function testDonorIndexSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'donor');
        
        $this->assertContains('Donors', $response->getContent());
    }
    // Test to test successful authorization for donor.index
    public function testDonorIndexSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'donor');
        
        $this->assertContains('Donors', $response->getContent());
    }

    
    public function tearDown() 
    {
        // Clean up test data
        $this->flushSession();
        
        $this->inactiveUser->delete();
        $this->basicUser->delete();
        $this->contactManager->delete();
        $this->projectManager->delete();
        $this->administrator->delete();

        parent::tearDown();
        Mockery::close();
    }
        
}
