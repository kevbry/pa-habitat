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
            'id' => '14',
            'name'=>'cool project',
            'created','2012-02-24 20:04:45',
            'updated_at'=> '2015-02-24 20:04:45',
            'family_id'=>'5',
            'build_number'=>'EJBU716N',
            'street_number'=> 'Apt55 GreenView Terrace',
            'postal_code'=> 'S8K 2K8',
            'city' => 'Greenwoods',
            'province' => 'SK',
            'start_date' =>'2015-01-14 21:04:45',
            'end_date'=>'2016-07-24 20:44:45',
            'comments'=> 'in-progress',
            'building_permit_number'=>'548FBL4J7ICF7',
            'building_permit_date'=> '2015-04-19',
            'mortgage_date'=>'2014-01-02',
            'blueprint_plan_number'=>'V836EI9',
            'blueprint_designer'=>'India Wilkins'
                
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
               ->shouldReceive('getProject')->once()->with(161);
              
        $this->call('GET','project/161/edit');
        $crawler = $this->client->request('GET', 'project/161/edit');
                $this->assertResponseOk();

        $this->assertCount(1, $crawler->filter('th:contains("Editing")'));
    } 
    /**
     * Test clean up
     */
    public function tearDown()
    {
         parent::tearDown();
        Mockery::close();
    }
}
