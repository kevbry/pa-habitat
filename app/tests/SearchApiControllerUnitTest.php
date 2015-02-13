<?php



class SearchApiControllerUnitTest extends TestCase {

    protected $mockedContactRepo;
    protected $mockedVolunteerRepo;
    protected $mockedProjectRepo;
    protected $mockedCompanyRepo;
    protected $mockedFamilyRepo;
    protected $mockedSearchController;
    protected $testController;
    
    protected $testRepo;

    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp() {
        parent::setUp();

        
//        $this->mockedSearchController = Mockery::mock('app\controllers\SearchAPIController');
//        $this->app->instance('app\controllers\SearchAPIController', $this->mockedSearchController);
        
        $this->mockedContactRepo = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->mockedContactRepo);

        $this->mockedCompanyRepo = Mockery::mock('app\repositories\CompanyRepository');
        $this->app->instance('app\repositories\CompanyRepository', $this->mockedCompanyRepo);

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
    public function testsearchContactsReturnsResults() {
        // Assemble
        $searchParam = "Bri";

        $searchResults = "Brielle Hayden";
        
        //$this->mockedSearchController->shouldReceive('searchContacts')->once()->with("Greg");
        $this->mockedContactRepo
                ->shouldReceive('getContactSearchInfo')
                ->once()
                ->with(Mockery::on(
                        function($filter) use($searchParam)
                {
                    $this->assertEquals($searchParam, $filter);
                    
                    return true;
                    
                }))
                ->andReturn("Brielle Hayden");
        
        // Act 
        //$response = $this->route("POST", 'search.searchContacts', array("contacts" => "Greg"));
        $response = $this->action("GET", 'SearchAPIController@searchContacts', array("contacts" => "Bri"));


        
        // Assert    
        $this->assertResponseStatus(200);
        $this->assertEquals($searchResults, $response->original);

        }

    /**
     * 
     * Testing the system can search for a Volunteer and returns a JSON array of matches
     */
    public function testsearchVolunteerReturnsResults() {
        // Assemble
        $searchParam = "Bri";

        $searchResults = "Brielle Hayden";
        
        //$this->mockedSearchController->shouldReceive('searchContacts')->once()->with("Greg");
        $this->mockedVolunteerRepo
                ->shouldReceive('getVolunteerSearchInfo')
                ->once()
                ->with(Mockery::on(
                        function($filter) use($searchParam)
                {
                    $this->assertEquals($searchParam, $filter);
                    
                    return true;
                    
                }))
                ->andReturn("Brielle Hayden");
        
        // Act 
        $response = $this->action("GET", 'SearchAPIController@searchVolunteers', array("volunteers" => "Bri"));


        
        // Assert    
        $this->assertResponseStatus(200);
        $this->assertEquals($searchResults, $response->original);
    }

    /*
     * Testing the system can search for a Project and returns a JSON array of matches
     */

    public function testsearchProjectReturnsResults() {
        // Assemble
        $searchParam = "Bri";

        $searchResults = "Brielle Hayden";
        
        //$this->mockedSearchController->shouldReceive('searchContacts')->once()->with("Greg");
        $this->mockedProjectRepo
                ->shouldReceive('getProjectSearchInfo')
                ->once()
                ->with(Mockery::on(
                        function($filter) use($searchParam)
                {
                    $this->assertEquals($searchParam, $filter);
                    
                    return true;
                    
                }))
                ->andReturn("Brielle Hayden");
        
        // Act 
        $response = $this->action("GET", 'SearchAPIController@searchProjects', array("projects" => "Bri"));


        
        // Assert    
        $this->assertResponseStatus(200);
        $this->assertEquals($searchResults, $response->original);
    }

    /*
     * Testing the system can search for a Project and returns a JSON array of matches
     */

    public function testsearchCompanyReturnsResults() {
        // Assemble
        $searchParam = "Bri";

        $searchResults = "Brielle Hayden";

        $this->mockedCompanyRepo
                ->shouldReceive('getCompanySearchInfo')
                ->once()
                ->with(Mockery::on(
                        function($filter) use($searchParam)
                {
                    $this->assertEquals($searchParam, $filter);
                    
                    return true;
                    
                }))
                ->andReturn("Brielle Hayden");
        
        // Act 
        $response = $this->action("GET", 'SearchAPIController@searchCompanies', array("companies" => "Bri"));


        // Assert    
        $this->assertResponseStatus(200);
        $this->assertEquals($searchResults, $response->original);
    }

   public function testsearchFamilyReturnsResults() {
        // Assemble
        $searchParam = "Smi";

        $searchResults = "Smiths";

        $this->mockedFamilyRepo
                ->shouldReceive('getFamilySearchInfo')
                ->once()
                ->with(Mockery::on(
                        function($filter) use($searchParam)
                {
                    $this->assertEquals($searchParam, $filter);
                    
                    return true;
                    
                }))
                ->andReturn($searchResults);
        
        // Act 
        $response = $this->action("GET", 'SearchAPIController@searchFamilies', array("families" => $searchParam));


        // Assert    
        $this->assertResponseStatus(200);
        $this->assertEquals($searchResults, $response->original);
    }    
    
    
    public function tearDown() {
        parent::tearDown();
        Mockery::close();
    }
    
}
