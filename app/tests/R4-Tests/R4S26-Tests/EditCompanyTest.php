<?php

class EditCompanyTest extends TestCase {

    protected $companyInput;
    protected $testCompany;
    protected $mockedCompanyRepo;
    protected $mockedCompanyController;
    protected $mockedContactRepo;

    public function setUp() {
        parent::setUp();

        // Create dummy Company and Contact information 

        $this->companyInput['name'] = 'Test Company ABC';
        $this->companyInput['contact_id'] = '12';

        $this->mockedCompanyRepo = Mockery::mock('App\Repositories\EloquentCompanyRepository');
        $this->app->instance('App\Repositories\CompanyRepository', $this->mockedCompanyRepo);

 

        $this->mockedCompanyController = Mockery::mock('app\controllers\CompanyController');
        $this->app->instance('app\controllers\CompanyController', $this->mockedCompanyController);
    }

    /**
     * Test that the controller can sucessfully edit a contact
     */
    public function StoreEditSuccess() {
        // Assemble
        $this->mockedCompanyController
                ->shouldReceive('update')->once()
                ->with($this->companyInput['id']);

        // Act 
        $this->mockedCompanyController->update($this->companyInput['id']);
        $this->route("PUT", "company.update", $this->companyInput);

        //Assert

        $this->assertResponseStatus(302);
    }

    public function testStoreEditFailure() {
        $this->companyInput = ['id' => 888];

        // Assemble
        $this->mockedCompanyController
                ->shouldReceive('update')->once()
                ->with($this->companyInput['id']);
        // Act 
        $this->mockedCompanyController->update($this->companyInput['id']);
        $this->route("PUT", "company.update", $this->companyInput);

        //Assert
        $this->assertRedirectedTo('company/888/edit');
    }

    /**
     * Test view all companies
     */
    public function testIndexForCompany() {
        $this->mockedCompanyRepo
                ->shouldReceive('getCompany')->once()->with(12)->passthru();

        $response = $this->call('GET', 'company/12/edit');

        $this->assertResponseOk();
        $this->assertContains("Editing Details", $response->getContent());
    }

    public function tearDown() {
        parent::tearDown();
        Mockery::close();
    }

}
