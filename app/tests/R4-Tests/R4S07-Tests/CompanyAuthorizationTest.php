<?php

class CompanyAuthorizationTest extends TestCase
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
    
    // Test to test failed authorization for company.index
    public function testCompanyIndexFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('GET', 'company');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for company.index
    public function testCompanyIndexSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'company');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for company.index
    public function testCompanyIndexSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'company');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for company.index
    public function testCompanyIndexSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'company');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for company.index
    public function testCompanyIndexSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'company');
        
        $this->assertContains('Companies', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for company.create
    public function testCompanyCreateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('GET', 'company/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for company.create
    public function testCompanyCreateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'company/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for company.create
    public function testCompanyCreateSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'company/create');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for company.create
    public function testCompanyCreateSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'company/create');
        
        $this->assertContains('Companies', $response->getContent());
    }
    // Test to test successful authorization for company.create
    public function testCompanyCreateSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        // Call route under test
        $response = $this->call('GET', 'company/create');
        
        $this->assertContains('Companies', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for company.store
    public function testCompanyStoreFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $this->call('POST', 'company');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for company.store
    public function testCompanyStoreFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('POST', 'company');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    
    
    
    
    
        // Test to test failed authorization for company.show
    public function testCompanyShowFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testCompanyID = 1;
        
        // Call route under test
        $this->call('GET', 'company/'.$testCompanyID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for company.show
    public function testCompanyShowSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testCompanyID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'company/'.$testCompanyID);
        
        // Assert redirected to access denied page
        $this->assertContains('Company details', $response->getContent());

    }
    // Test to test successful authorization for company.show
    public function testCompanyShowSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testCompanyID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'company/'.$testCompanyID);
        
        $this->assertContains('Company details', $response->getContent());

    }
    // Test to test successful authorization for company.show
    public function testCompanyShowSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testCompanyID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'company/'.$testCompanyID);
        
        $this->assertContains('Company details', $response->getContent());
    }
    // Test to test successful authorization for company.show
    public function testCompanyShowSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testCompanyID = 1;
        
        // Call route under test
        $response = $this->call('GET', 'company/'.$testCompanyID);
        
        $this->assertContains('Company details', $response->getContent());
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
