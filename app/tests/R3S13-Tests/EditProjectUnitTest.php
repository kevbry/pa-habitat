<?php
/**
 * Description of ProjectUnitTests
 *
 * @author cst222
 */
class EditProjectUnitTest extends TestCase
{
    protected $mockedProjectRepo;
    protected $mockedProjectController;
    
    protected $projectInput;
    protected $invalidDataException;
    
    /**
     * Set up function for the tests.  Creates dummy objects to use for Testing.
     */
    public function setUp()
    {
        parent::setUp();

        // Create dummy Project information
        $this->projectInput = [
                
         ];
        

        // Instantiate objects with dummy data

        $this->mockedProjectRepo = Mockery::mock('app\repositories\ProjectRepository');
        $this->app->instance('app\repositories\ProjectRepository', $this->mockedProjectRepo);
        
        $this->mockedProjectController = Mockery::mock('app\controllers\ProjectController');
        $this->app->instance('app\controllers\ProjectController', $this->mockedProjectController);
    }
    /**
     * Test that the controller can sucessfully edit a project
     */
    public function testStoreEditSuccess()
    {
        // Assemble
        $this->mockedProjectController
                ->shouldReceive('update')->once()
                ->with($this->projectInput['id']);

        // Act 
        $this->mockedProjectController->update($this->projectInput['id']);
        $this->route("PUT", "project.update", $this->projectInput);

        //Assert
        //$this->assertRedirectedToAction("ProjectController@update",1);
        $this->assertResponseStatus(302);
        //$this->assertRedirectedTo('project/555');
    }
    
    public function testStoreEditFailure()
    {
        $this->projectInput = ['id'=>555];
        
        // Assemble
        $this->mockedProjectController
                ->shouldReceive('update')->once()
                ->with($this->projectInput['id']);
        // Act 
        $this->mockedProjectController->update($this->projectInput['id']);
        $this->route("PUT", "project.update", $this->projectInput);

        //Assert
        $this->assertRedirectedTo('project/555/edit');
    }
    public function testShowEditProject()
    {
       $this->mockedProjectRepo
               ->shouldReceive('getProject')->once()->with(1);
              
        $this->call('GET','project/edit/1');
        $crawler = $this->client->request('GET', 'project/edit/1');
        
        $this->assertResponseOk();
        $this->assertCount(1, $crawler->filter('th:contains("Editing")'));
    } 
    /**
     * Test clean up
     */
    public function tearDown()
    {
        Mockery::close();
    }
}
