<?php

class UserAuthorizationTest extends TestCase
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
    
    // Test to test failed authorization for user.index
    public function testUserIndexFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('GET', 'user');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for user.index
    public function testUserIndexSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'user');
        
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for user.index
    public function testUserIndexSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'user');
        
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for user.index
    public function testUserIndexSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'user');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for user.index
    public function testUserIndexSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'user');
        
        $this->assertContains('Companies', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for user.create
    public function testUserCreateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('GET', 'user/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for user.create
    public function testUserCreateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'user/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for user.index
    public function testUserCreateSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'user/create');
        
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for user.index
    public function testUserCreateSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'user/create');
        
        $this->assertContains('Create a User', $response->getContent());
    }
    // Test to test successful authorization for user.index
    public function testUserCreateSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'user/create');
        
        $this->assertContains('Create a User', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for user.store
    public function testUserStoreFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('POST', 'user');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for user.store
    public function testUserStoreFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('POST', 'user');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    
    
    
    
        // Test to test failed authorization for user.show
    public function testUserShowFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testUserID = 1;
        
        // Call route under test
        $this->call('GET', 'user/'.$testUserID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for user.show
    public function testUserShowSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testUserID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'user/'.$testUserID);
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test successful authorization for user.show
    public function testUserShowSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testUserID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'user/'.$testUserID);
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test successful authorization for user.show
    public function testUserShowSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testUserID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'user/'.$testUserID);
        
        $this->assertContains("User Details", $response->getContent());
    }
    // Test to test successful authorization for user.show
    public function testUserShowSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testUserID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'user/'.$testUserID);
        
        $this->assertContains("User Details", $response->getContent());
    }
    
    
           // Test to test failed authorization for user.edit
    public function testUserEditFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testUserID = 1;
        
        // Call route under test
        $this->call('GET', 'user/'.$testUserID.'/edit');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for user.show
    public function testUserEditFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testUserID = 1;
        
        // Call route under test
        $this->call('GET', 'user/'.$testUserID.'/edit');
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test failed authorization for user.edit
    public function testUserEditFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testUserID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'user/'.$testUserID.'/edit');
        
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for user.edit
    public function testUserEditFailure_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testUserID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'user/'.$testUserID.'/edit');
        
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for user.edit
    public function testUserEditSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testUserID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'user/'.$testUserID.'/edit');
        
        $this->assertContains("User Details", $response->getContent());

    }
    
    
    
    
    
    
    // Test to test failed authorization for user.update
    public function testUserUpdateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testUserID = 1;
        
        // Call route under test
        $this->call('PUT', 'user/'.$testUserID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for user.update
    public function testUserUpdateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        $testUserID = 1;
        
        // Call route under test
        $response = $this->call('PUT', 'user/'.$testUserID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
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
