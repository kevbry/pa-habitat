<?php

class SearchApiControllerUnitTest extends TestCase {

    protected $mockedContactRepo;
    protected $mockedVolunteerRepo;
    protected $mockedProjectRepo;
    protected $mockedCompanyRepo;
    protected $mockedFamilyRepo;
    protected $mockedSearchController;
    protected $testController;

    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp() {
        parent::setUp();

        
        $this->mockedSearchController = Mockery::mock('app\controllers\SearchAPIController');
        $this->app->instance('app\controllers\SearchAPIController', $this->mockedSearchController);
        
        $this->mockedContactRepo = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->mockedContactRepo);

        $this->mockedCompanyRepo = Mockery::mock('app\repositories\CompanyRepository');
        $this->app->instance('app\respositories\CompanyRepository', $this->mockedCompanyRepo);

        $this->mockedVolunteerRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app\repositories\VolunteerRepository', $this->mockedVolunteerRepo);
        
        $this->mockedContactController = Mockery::mock('app\controllers\SearchApiController');
        $this->app->instance('app\controllers\SearchApiController', $this->mockedSearchController);

        $this->mockedProjectRepo = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->mockedProjectRepo);
        
         $this->mockedFamilyRepo = Mockery::mock('app\repositories\FamilyRepository');
        $this->app->instance('app\repositories\FamilyRepository', $this->mockedFamilyRepo);

        $this->testController = new SearchAPIController($this->mockedContactRepo , $this->mockedVolunteerRepo,
                                    $this->mockedProjectRepo , $this->mockedCompanyRepo, $this->mockedFamilyRepo);
    }

    /**
     * 
     * Testing the system can search for a contact and returns a JSON array of matches
     */
    public function testsearchContacts() {
        // Assemble
        $this->mockedSearchController->shouldReceive('searchContacts')->once()->with("Greg");
        $this->mockedContactRepo->shouldReceive('getContactSearchInfo')->once("Greg");


        // Act 
        $response = $this->call("GET", 'search/searchContacts', array("contacts" => "Greg"));

        // Assert
        $this->assertEquals("Greg Smith", $response->getContent());
        
        
        
    }

    /**
     * 
     * Testing the system can search for a Volunteer and returns a JSON array of matches
     */
    public function testsearchVolunteer() {
        // Assemble
        $this->mockedSearchController->shouldReceive('searchVolunteer')->once()->with("");
        $this->mockedVolunteerRepo->shouldReceive('getVolunteerSearchInfo')->once()->with("");

        // Act 
        $response = $this->route("POST", "search.searchVolunteers", "");


        // Assert
        $this->assertTrue("", $response);
    }

    /*
     * Testing the system can search for a Project and returns a JSON array of matches
     */

    public function testsearchProject() {
        // Assemble
        $this->mockedSearchController->shouldReceive('searchProject')->once()->with("");
        $this->mockedProjectRepo->shouldReceive('getProjectSearchInfo')->once()->with("");

        // Act 
        $response = $this->route("POST", "search.searchProjects", "");


        // Assert
        $this->assertTrue("", $response);
    }

    /*
     * Testing the system can search for a Project and returns a JSON array of matches
     */

    public function testsearchCompany() {
        // Assemble
        $this->mockedSearchController->shouldReceive('searchCompany')->once()->with("");
        $this->mockedCompanyRepo->shouldReceive('getCompanySearchInfo')->once()->with("");

        // Act 
        $response = $this->route("POST", "search.searchCompanies", "");


        // Assert
        $this->assertTrue("", $response);
    }

}
