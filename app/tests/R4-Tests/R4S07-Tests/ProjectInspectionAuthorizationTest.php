<?php

class ProjectInspectionAuthorizationTest extends TestCase
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
    
    // Test to test failed authorization for projectinspection.index
    public function testProjectInspectionIndexFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for projectinspection.index
    public function testProjectInspectionIndexSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections');
        
        $this->assertContains('Inspections for', $response->getContent());
    }
    // Test to test successful authorization for projectinspection.index
    public function testProjectInspectionIndexSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections');
        
        $this->assertContains('Inspections for', $response->getContent());
    }
    // Test to test successful authorization for projectinspection.index
    public function testProjectInspectionIndexSuccess_ProjectInspectionManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections');
        
        $this->assertContains('Inspections for', $response->getContent());
    }
    // Test to test successful authorization for projectinspection.index
    public function testProjectInspectionIndexSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections');
        
        $this->assertContains('Inspections for', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for projectinspection.create
    public function testProjectInspectionCreateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectinspection.create
    public function testProjectInspectionCreateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectinspection.index
    public function testProjectInspectionCreateFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/create');
        
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for projectinspection.index
    public function testProjectInspectionCreateSuccess_ProjectInspectionManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/create');
        
        $this->assertContains('Inspections for', $response->getContent());
    }
    // Test to test successful authorization for projectinspection.index
    public function testProjectInspectionCreateSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/create');
        
        $this->assertContains('Inspections for', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for projectinspection.store
    public function testProjectInspectionStoreFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('POST', 'project/'.$testProjectID.'/inspections/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectinspection.store
    public function testProjectInspectionStoreFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('POST', 'project/'.$testProjectID.'/inspections/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }    
    // Test to test failed authorization for projectinspection.store
    public function testProjectInspectionStoreFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('POST', 'project/'.$testProjectID.'/inspections/create');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    
    
    
    
           // Test to test failed authorization for projectinspection.edit
    public function testProjectInspectionEditFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/edit');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectinspection.edit
    public function testProjectInspectionEditFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/edit');
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test failed authorization for projectinspection.edit
    public function testProjectInspectionEditFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/edit');
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test successful authorization for projectinspection.edit
    public function testProjectInspectionEditSuccess_ProjectInspectionManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/edit');
        
        $this->assertContains("Edit Inspections for", $response->getContent());
    }
    // Test to test successful authorization for projectinspection.edit
    public function testProjectInspectionEditSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'project/'.$testProjectID.'/inspections/edit');
        
        $this->assertContains("Edit Inspections for", $response->getContent());
    }
    
    
    
    
    
    
    // Test to test failed authorization for projectinspection.update
    public function testProjectInspectionUpdateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'project/'.$testProjectID.'/inspections/edit');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectinspection.update
    public function testProjectInspectionUpdateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'project/'.$testProjectID.'/inspections/edit');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for projectinspection.update
    public function testProjectInspectionUpdateFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'project/'.$testProjectID.'/inspections/edit');
        
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
