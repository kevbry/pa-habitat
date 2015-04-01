<?php

class ContactAuthorizationTest extends TestCase
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
    
    // Test to test failed authorization for contact.index
    public function testContactIndexFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('GET', 'contact');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for contact.index
    public function testContactIndexSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'contact');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for contact.index
    public function testContactIndexSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'contact');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for contact.index
    public function testContactIndexSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'contact');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for contact.index
    public function testContactIndexSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'contact');
        
        $this->assertContains('Companies', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for contact.create
    public function testContactCreateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('GET', 'contact/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for contact.create
    public function testContactCreateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'contact/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for contact.index
    public function testContactCreateSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'contact/create');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for contact.index
    public function testContactCreateSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'contact/create');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for contact.index
    public function testContactCreateSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'contact/create');
        
        $this->assertContains('Companies', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for contact.store
    public function testContactStoreFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('POST', 'contact');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for contact.store
    public function testContactStoreFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('POST', 'contact');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    
    
    
    
        // Test to test failed authorization for contact.show
    public function testContactShowFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testContactID = 1;
        
        // Call route under test
        $this->call('GET', 'contact/'.$testContactID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for contact.show
    public function testContactShowSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testContactID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'contact/'.$testContactID);
        
        $this->assertContains("'s Details", $response->getContent());

    }
    // Test to test successful authorization for contact.show
    public function testContactShowSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testContactID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'contact/'.$testContactID);
        
        $this->assertContains("'s Details", $response->getContent());

    }
    // Test to test successful authorization for contact.show
    public function testContactShowSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testContactID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'contact/'.$testContactID);
        
        $this->assertContains("'s Details", $response->getContent());
    }
    // Test to test successful authorization for contact.show
    public function testContactShowSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testContactID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'contact/'.$testContactID);
        
        $this->assertContains("'s Details", $response->getContent());
    }
    
    
    
    
    
    
    
    
    
    
    
           // Test to test failed authorization for contact.edit
    public function testContactEditFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testContactID = 1;
        
        // Call route under test
        $this->call('GET', 'contact/'.$testContactID.'/edit');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for contact.show
    public function testContactEditFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testContactID = 1;
        
        // Call route under test
        $this->call('GET', 'contact/'.$testContactID.'/edit');
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test successful authorization for contact.edit
    public function testContactEditSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testContactID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'contact/'.$testContactID.'/edit');
        
        $this->assertContains("Editing Details for", $response->getContent());

    }
    // Test to test successful authorization for contact.edit
    public function testContactEditSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testContactID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'contact/'.$testContactID.'/edit');
        
        $this->assertContains("Editing Details for", $response->getContent());
    }
    // Test to test successful authorization for contact.edit
    public function testContactEditSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testContactID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'contact/'.$testContactID.'/edit');
        
        $this->assertContains("Editing Details for", $response->getContent());
    }
    
    
    
    
    
    
    // Test to test failed authorization for contact.update
    public function testContactUpdateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testContactID = 1;
        
        // Call route under test
        $this->call('PUT', 'contact/'.$testContactID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for contact.update
    public function testContactUpdateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        $testContactID = 1;
        
        // Call route under test
        $response = $this->call('PUT', 'contact/'.$testContactID);
        
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
