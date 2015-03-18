<?php
 
class ProjectRoleTest extends TestCase 
{

    protected $mockedProjectContactController;
    protected $mockedProjectContactRepository;
    protected $projectContactInput;
    protected $invalidDataException;
    protected $projectContactRepository;
    protected $projectRepository;
    protected $contactRepository;
    
    public function setUp()
    {
        parent::setUp();
        $this->projectContactInput = [];
        
    }
        
    /**
     * Test that the controller can sucessfully add items to the database
     */
    public function testStoreSingleEntrySuccess()
    {
        $this->projectContactRepository = Mockery::mock('app\repositories\ProjectContactRepository');
        $this->app->instance('app\repositories\ProjectContactRepository', $this->projectContactRepository);
        $this->projectRepository = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->projectRepository);
        $this->contactRepository = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->contactRepository);
        $this->projectRolesRepository = Mockery::mock('app\repositories\ProjectRolesRepository');
        $this->app->instance('app\repositories\ProjectRolesRepository', $this->projectRolesRepository);
        
        $this->mockedProjectContactController = Mockery::mock('ProjectContactController[storeContactWith]', 
                array($this->projectContactRepository,$this->projectRepository,$this->contactRepository, $this->projectRolesRepository));
        $this->app->instance('ProjectContactController', $this->mockedProjectContactController);

        $this->projectContactInput = [
            'dummyvalue' => 'mystery',
            'contact_id' => 1,
            'project_id' => 2,
            'role_id' => 1,
            'notes' => 'Batteries not included'
         ];
        $this->mockedProjectContactController->shouldReceive('storeContactWith')->once()->andReturn(2);

        // Act 
        $response = $this->action("POST", "ProjectContactController@store", $this->projectContactInput);

        // Assert
        //$this->assertRedirectedToAction('ProjectContactController@index',2);
        $this->assertRedirectedToRoute('projContactsView',2);

    }
    
    public function testIndexRoute()
    {
        $this->projectContactRepository = Mockery::mock('app\repositories\ProjectContactRepository');
        $this->app->instance('app\repositories\ProjectContactRepository', $this->projectContactRepository);
        
        $this->projectContactRepository->shouldReceive('getContactsForProject');
        
        $this->projectRepository = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->projectRepository);
        
        $this->projectRepository->shouldReceive('getProject');
        
        $this->contactRepository = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->contactRepository);
        
        $this->contactRepository->shouldReceive('getAllContactsNonPaginated');
        
        $this->projectRolesRepository = Mockery::mock('app\repositories\ProjectRolesRepository');
        $this->app->instance('app\repositories\ProjectRolesRepository', $this->projectRolesRepository);
        
        $this->projectRolesRepository->shouldReceive('getAllRoles');
        
        $this->mockedProjectContactController = Mockery::mock('ProjectContactController[storeContactWith]', 
                array($this->projectContactRepository,$this->projectRepository,$this->contactRepository, $this->projectRolesRepository));
        $this->app->instance('ProjectContactController', $this->mockedProjectContactController);
        
        $response = $this->action('GET', 'ProjectContactController@index');
        
        $this->assertResponseOk();
    } 
     
    public function testCreate()
    {
        $this->projectContactRepository = Mockery::mock('app\repositories\ProjectContactRepository');
        $this->app->instance('app\repositories\ProjectContactRepository', $this->projectContactRepository);
        $this->projectRepository = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->projectRepository);
        $this->contactRepository = Mockery::mock('app\repositories\ContactRepository');
        $this->app->instance('app\repositories\ContactRepository', $this->contactRepository);
        
        $this->contactRepository->shouldReceive('getAllContactsNonPaginated');
        
        $this->projectRolesRepository = Mockery::mock('app\repositories\ProjectRolesRepository');
        $this->app->instance('app\repositories\ProjectRolesRepository', $this->projectRolesRepository);
        
        $this->projectRolesRepository->shouldReceive('getAllRoles');

                $this->projectRepository->shouldReceive('getProject');
        $this->mockedProjectContactController = Mockery::mock('ProjectContactController[create]', 
                array($this->projectContactRepository,$this->projectRepository,$this->contactRepository, $this->projectRolesRepository));
        $this->app->instance('ProjectContactController', $this->mockedProjectContactController);
        
        $this->mockedProjectContactController->shouldReceive('create')->once();
        
        $response = $this->action('GET', 'ProjectContactController@create');
        
        $this->assertResponseOk();
    }
    
    /*
     * Test clean up
     */
    public function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }    
    
}


