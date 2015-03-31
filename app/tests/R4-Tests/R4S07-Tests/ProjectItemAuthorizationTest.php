<?php

class ProjectItemAuthorizationTest extends TestCase
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

        $this->inactiveUser = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '1000', 'access_level' => 'inactive'));
        $this->basicUser = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '2000', 'access_level' => 'basic_user'));
        $this->contactManager = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '3000', 'access_level' => 'contact_manager'));
        $this->projectManager = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '4000', 'access_level' => 'project_manager'));
        $this->administrator = new User(array('username' => 'Test', 'password' => 'asdf', 'contact_id' => '5000', 'access_level' => 'administrator'));
        
    }
    
    // Test to test failed authorization for projectitem.index
    public function testProjectItemIndexFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for projectitem.index
    public function testProjectItemIndexSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items');
        
        $this->assertContains('Items for', $response->getContent());
    }
    // Test to test successful authorization for projectitem.index
    public function testProjectItemIndexSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items');
        
        $this->assertContains('Items for', $response->getContent());
    }
    // Test to test successful authorization for projectitem.index
    public function testProjectItemIndexSuccess_ProjectItemManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items');
        
        $this->assertContains('Items for', $response->getContent());
    }
    // Test to test successful authorization for projectitem.index
    public function testProjectItemIndexSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items');
        
        $this->assertContains('Items for', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for projectitem.create
    public function testProjectItemCreateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectitem.create
    public function testProjectItemCreateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectitem.index
    public function testProjectItemCreateFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/create');
        
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for projectitem.index
    public function testProjectItemCreateSuccess_ProjectItemManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/create');
        
        $this->assertContains('Items for', $response->getContent());
    }
    // Test to test successful authorization for projectitem.index
    public function testProjectItemCreateSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/create');
        
        $this->assertContains('Items for', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for projectitem.store
    public function testProjectItemStoreFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('POST', 'project/'.$testProjectID.'/items/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectitem.store
    public function testProjectItemStoreFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('POST', 'project/'.$testProjectID.'/items/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }    
    // Test to test failed authorization for projectitem.store
    public function testProjectItemStoreFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('POST', 'project/'.$testProjectID.'/items/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    
    
    
    
           // Test to test failed authorization for projectitem.edit
    public function testProjectItemEditFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/edit');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectitem.edit
    public function testProjectItemEditFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/edit');
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test failed authorization for projectitem.edit
    public function testProjectItemEditFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/edit');
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test successful authorization for projectitem.edit
    public function testProjectItemEditSuccess_ProjectItemManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/edit');
        
        $this->assertContains("Edit Items for", $response->getContent());
    }
    // Test to test successful authorization for projectitem.edit
    public function testProjectItemEditSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/items/edit');
        
        $this->assertContains("Edit Items for", $response->getContent());
    }
    
    
    
    
    
    
    // Test to test failed authorization for projectitem.update
    public function testProjectItemUpdateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'project/'.$testProjectID.'/items/edit');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectitem.update
    public function testProjectItemUpdateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'project/'.$testProjectID.'/items/edit');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectitem.update
    public function testProjectItemUpdateFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'project/'.$testProjectID.'/items/edit');
        
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
