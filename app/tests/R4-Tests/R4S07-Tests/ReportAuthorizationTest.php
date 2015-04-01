<?php

class ReportAuthorizationTest extends TestCase
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
    
    // Test to test failed authorization for report.viewHoursReport
    public function testVolunteerHourReportFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/report/'.$volunteerID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failure authorization for report.viewHoursReport
    public function testVolunteerHourReportFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/report/'.$volunteerID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for report.viewHoursReport
    public function testVolunteerHourReportSuccess_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/report/'.$volunteerID);
        
        $this->assertContains('Total Hours', $response->getContent());
    }
    // Test to test successful authorization for report.viewHoursReport
    public function testVolunteerHourReportSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/report/'.$volunteerID);
        
        $this->assertContains('Total Hours', $response->getContent());
    }
    // Test to test successful authorization for report.viewHoursReport
    public function testVolunteerHourReportSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $volunteerID = 2;
        // Call route under test
        $response = $this->call('GET', 'volunteerhours/report/'.$volunteerID);
        
        $this->assertContains('Total Hours', $response->getContent());
    }
    
    
    
    
    
    // Test to test failed authorization for report.viewHoursReportForProject
    public function testCompanyIndexFailure_Inactive()
    {
        $this->session([
            'username' => $this->inactiveUser->username, 
            'access_level' => $this->inactiveUser->access_level
            ]);
        
        // Set test user as current authenticated user
        $this->be($this->inactiveUser);
        
        $projectID = 1;
        // Call route under test
        $response = $this->call('GET', 'projecthours/report/'.$projectID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for report.viewHoursReportForProject
    public function testCompanyIndexFailure_BasicUser()
    {
        // Set test user as current authenticated user
        $this->be($this->basicUser);
        
        $this->session([
            'username' => $this->basicUser->username, 
            'access_level' => $this->basicUser->access_level
            ]);
        
        $projectID = 1;
        // Call route under test
        $response = $this->call('GET', 'projecthours/report/'.$projectID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test failed authorization for report.viewHoursReportForProject
    public function testCompanyIndexFailure_ContactManager()
    {
        // Set test user as current authenticated user
        $this->be($this->contactManager);
        
        $this->session([
            'username' => $this->contactManager->username, 
            'access_level' => $this->contactManager->access_level
            ]);

        $projectID = 1;
        // Call route under test
        $response = $this->call('GET', 'projecthours/report/'.$projectID);
        
        // Assert redirected to access denied page
        $this->assertRedirectedToRoute('unauthorized');
    }
    // Test to test successful authorization for report.viewHoursReportForProject
    public function testCompanyIndexSuccess_ProjectManager()
    {
        // Set test user as current authenticated user
        $this->be($this->projectManager);
        
        $this->session([
            'username' => $this->projectManager->username, 
            'access_level' => $this->projectManager->access_level
            ]);
        
        $projectID = 1;
        // Call route under test
        $response = $this->call('GET', 'projecthours/report/'.$projectID);
        
        $this->assertContains('Total Hours', $response->getContent());
    }
    // Test to test successful authorization for report.viewHoursReportForProject
    public function testCompanyIndexSuccess_Administrator()
    {
        // Set test user as current authenticated user
        $this->be($this->administrator);
        
        $this->session([
            'username' => $this->administrator->username, 
            'access_level' => $this->administrator->access_level
            ]);
        
        $projectID = 1;
        // Call route under test
        $response = $this->call('GET', 'projecthours/report/'.$projectID);
        
        $this->assertContains('Total Hours', $response->getContent());
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
