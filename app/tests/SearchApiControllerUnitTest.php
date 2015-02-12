<?php

class SearchApiControllerUnitTest extends TestCase {

    protected $mockedContactRepo;
    protected $mockedVolunteerRepo;
    protected $mockedProjectRepo;
//    protected $mockedCompanyRepo;
//    protected $mockedDonorRepo;
    protected $mockedSearchController;

    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp() {
        parent::setUp();

        $this->mockedContactRepo = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->mockedContactRepo);

//        $this->mockedCompanyRepo = Mockery::mock('app\repositories\CompanyRepository');
//        $this->app->instance('app\respositories\CompanyRepository', $this->mockedCompanyRepo);
//
        $this->mockedVolunteerRepo = Mockery::mock('app\repositories\VolunteerRepository');
        $this->app->instance('app\repositories\VolunteerRepository', $this->mockedVolunteerRepo);
//
//        $this->mockedDonorRepo = Mockery::mock('app\repositories\DonorRepository');
//        $this->app->instance('app\repositories\DonorRepository', $this->mockedDonorRepo);

        $this->mockedContactController = Mockery::mock('app\controllers\SearchApiController');
        $this->app->instance('app\controllers\SearchApiController', $this->mockedSearchController);

        // $this->testController = new ContactController($this->mockedContactRepo, $this->mockedVolunteerRepo, $this->mockedCompanyRepo, $this->mockedDonorRepo);

        $this->mockedProjectRepo = Mockery::mock('app\repositories\ProjecttRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->mockedProjectRepoRepo);

        $this->testController = new SearchAPIController($this->mockedContactRepo);
    }

    /**
     * 
     * Testing the system can search for a contact and returns a JSON array of matches
     */
    public function testsearchContacts() {
        // Assemble
        $this->mockedSearchAPIController->shouldReceive('searchContacts')->once()->with("");
        $this->mockedContactRepo->shouldReceive('getContactSearchInfo')->once()->with("");

        // Act 
        $response = $this->route("POST", "search.contact", "");


        // Assert
        $this->assertTrue("", $response);
    }

    /**
     * 
     * Testing the system can search for a Volunteer and returns a JSON array of matches
     */
    public function testsearchVolunteer() {
        // Assemble
        $this->mockedSearchAPIController->shouldReceive('searchVolunteer')->once()->with("");
        $this->mockedVolunteerRepo->shouldReceive('getVolunteerSearchInfo')->once()->with("");

        // Act 
        $response = $this->route("POST", "search.volunteer", "");


        // Assert
        $this->assertTrue("", $response);
    }

    /*
     * Testing the system can search for a Project and returns a JSON array of matches
     */

    public function testsearchProject() {
        // Assemble
        $this->mockedSearchAPIController->shouldReceive('searchProject')->once()->with("");
        $this->mockedProjectRepo->shouldReceive('getProjectSearchInfo')->once()->with("");

        // Act 
        $response = $this->route("POST", "search.project", "");


        // Assert
        $this->assertTrue("", $response);
    }

}
