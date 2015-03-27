<?php

class VolunteerHourAuthorizationTest extends TestCase
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
    
    // Test to test failed authorization for volunteerhour.indexForContact
    public function testVolunteerHourIndexForContactFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteer/'.$volunteerID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for volunteerhour.indexForContact
    public function testVolunteerHourIndexForContactSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteer/'.$volunteerID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.indexForContact
    public function testVolunteerHourIndexForContactSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteer/'.$volunteerID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.indexForContact
    public function testVolunteerHourIndexForContactSuccess_ProjectItemManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteer/'.$volunteerID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.indexForContact
    public function testVolunteerHourIndexForContactSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteer/'.$volunteerID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    
    
    
    // Test to test failed authorization for volunteerhour.indexForProject
    public function testVolunteerHourIndexForProjectFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/project/'.$projectID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for volunteerhour.indexForProject
    public function testVolunteerHourIndexForProjectSuccess_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/project/'.$projectID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.indexForProject
    public function testVolunteerHourIndexForProjectSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/project/'.$projectID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.indexForProject
    public function testVolunteerHourIndexForProjectSuccess_ProjectItemManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/project/'.$projectID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.indexForProject
    public function testVolunteerHourIndexForProjectSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/project/'.$projectID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    
    
    
    
    // Test to test failed authorization for volunteerhour.createForProject
    public function testVolunteerHourCreateForProjectFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/project/'.$testProjectID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.createForProject
    public function testVolunteerHourCreateForProjectFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/project/'.$testProjectID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.createForProject
    public function testVolunteerHourCreateForProjectFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/project/'.$testProjectID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for volunteerhour.createForProject
    public function testVolunteerHourCreateForProjectSuccess_ProjectItemManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/project/'.$testProjectID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
        
    }
    // Test to test successful authorization for volunteerhour.createForProject
    public function testVolunteerHourCreateForProjectSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $testProjectID = 1;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/project/'.$testProjectID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }

    
    
    
    // Test to test failed authorization for volunteerhour.createForContact
    public function testVolunteerHourCreateForContactFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/volunteer/'.$volunteerID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.createForContact
    public function testVolunteerHourCreateForContactFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/volunteer/'.$volunteerID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.createForContact
    public function testVolunteerHourCreateForContactFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/volunteer/'.$volunteerID);
        
        // Assert redirected to access denied page
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.createForContact
    public function testVolunteerHourCreateForContactSuccess_ProjectItemManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/volunteer/'.$volunteerID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
        
    }
    // Test to test successful authorization for volunteerhour.createForContact
    public function testVolunteerHourCreateForContactSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/add/volunteer/'.$volunteerID);
        
        $this->assertContains('Volunteer Hours for', $response->getContent());
    }
    
    
    // Test to test failed authorization for volunteerhour.storehours
    public function testVolunteerHourProjectStoreFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        // Call route under test
        $response = $this->call('POST', 'volunteerhours');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.storehours
    public function testVolunteerHourProjectStoreFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        // Call route under test
        $response = $this->call('POST', 'volunteerhours');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }     
    
    
    // Test to test failed authorization for volunteerhour.indexForEditContact
    public function testVolunteerHourContactEditFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteerEdit/'.$volunteerID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.indexForEditContact
    public function testVolunteerHourContactEditFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteerEdit/'.$volunteerID);
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test failed authorization for volunteerhour.indexForEditContact
    public function testVolunteerHourContactEditFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteerEdit/'.$volunteerID);
        
        $this->assertContains("Editing Volunteer Hours for", $response->getContent());

    }
    // Test to test successful authorization for volunteerhour.indexForEditContact
    public function testVolunteerHourContactEditSuccess_ProjectItemManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteerEdit/'.$volunteerID);
        
        $this->assertContains("Editing Volunteer Hours for", $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.indexForEditContact
    public function testVolunteerHourContactEditSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/volunteerEdit/'.$volunteerID);
        
        $this->assertContains("Editing Volunteer Hours for", $response->getContent());
    }
    
    
    // Test to test failed authorization for volunteerhour.updatehours
    public function testVolunteerHourUpdateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'volunteerhours/volunteerEdit/');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.updatehours
    public function testVolunteerHourUpdateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'volunteerhours/volunteerEdit/');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }

    
    
    // Test to test failed authorization for volunteerhour.indexForEditProject
    public function testVolunteerHourProjectEditFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/edit/project/'.$projectID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.indexForEditProject
    public function testVolunteerHourProjectEditFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/edit/project/'.$projectID);
        
        $this->assertRedirectedToRoute('unauthorized');

    }
    // Test to test passed authorization for volunteerhour.indexForEditProject
    public function testVolunteerHourProjectEditFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/edit/project/'.$projectID);
        
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for volunteerhour.indexForEditProject
    public function testVolunteerHourProjectEditSuccess_ProjectInspectionManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/edit/project/'.$projectID);
        
        $this->assertContains("Editing Project Hours for", $response->getContent());
    }
    // Test to test successful authorization for volunteerhour.indexForEditProject
    public function testVolunteerHourProjectEditSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $projectID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/edit/project/'.$projectID);
        
        $this->assertContains("Editing Project Hours for", $response->getContent());
    }
    
    
    
    // Test to test failed authorization for volunteerhour.updateProjectHours
    public function testVolunteerHourProjectUpdateFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'volunteerhours/edit/project/');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for volunteerhour.updateProjectHours
    public function testVolunteerHourProjectUpdateFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'volunteerhours/edit/project/');
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
        // Test to test failed authorization for volunteerhour.updateProjectHours
    public function testVolunteerHourProjectUpdateFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        $testProjectID = 1;        
        // Call route under test
        $this->call('POST', 'volunteerhours/edit/project/');
        
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
