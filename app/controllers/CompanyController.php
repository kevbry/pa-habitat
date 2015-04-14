<?php

use App\Repositories\CompanyRepository;
use App\Repositories\ContactRepository;

class CompanyController extends \BaseController {

    public $companyRepo;
    public $contactRepo;

    public function __construct(CompanyRepository $companyRepo, ContactRepository $contactRepo) {
        $this->companyRepo = $companyRepo;
        $this->contactRepo = $contactRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        // Retrieve all companies from the database

        $sortby = Input::get('sortby');
        $order = Input::get('order');

        if ($sortby && $order) {

            $companyList = $this->companyRepo->orderBy($sortby, $order);
        } else {
            $companyList = $this->companyRepo->getAllCompanies();
        }

        // Return that to the list view
        return View::make('company.index', compact('sortby', 'order'))->with('companies', $companyList);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $company = $this->companyRepo->getCompany($id);

        return View::make('company.show')
                        ->withCompany($company);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('company.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store() {
        $errorList['name'] = Input::get('name');
        $errorList['primary_contact_1'] = Input::get('primary_contact_1');    
       
         // Retrieve company information from user
        $companyInput['name'] = Input::get('name');
        $companyInput['contact_id'] = Input::get('primary_contact_1');

        $v = new App\Libraries\Validators\CompanyValidator($errorList);
        if($v->passes())
        {
            //Store company
            $companyID = $this->createCompanyWith($companyInput);

            // If the company was successfully created
            if ($companyID > 0)
            {
                return Redirect::action('CompanyController@show', $companyID);
            }
        }
        else
        {
            //otherwise return back to the company, with the same inputs, and the error messages.
            return Redirect::action('CompanyController@create')->withInput()->withErrors($v->getErrors());
        }
    }

    public function createCompanyWith($data) {
        $company = new Company($data);

        $this->companyRepo->saveCompany($company);

        return $company->id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $company = $this->companyRepo->GetCompany($id);
        // $contact = $this->contactRepo->GetContact($company->contact_id);

        return View::make('company.edit')
                        ->withCompany($company);
        //  ->withContact($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        
        $errorList['name'] = Input::get('name');
        $errorList['primary_contact_1'] = Input::get('primary_contact_1');   
        
        //Array of values to update
        $companyInfo = Input::only(
                        'name', 'primary_contact_1');

        // Array of field names
        $fieldNames = array(
            'name',
            'contact_id');
   
        $counter = 0;
        
        $v = new App\Libraries\Validators\CompanyValidator($errorList);
        if($v->passes())
        {
            $fieldUpdateValues = array();

            foreach ($companyInfo as $fieldValue) {
                $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
                $counter++;
            }

            $affectedRows = Company::where('id', '=', $id)->update($fieldUpdateValues);

            if ($affectedRows > 0) {

                $redirectVariable = Redirect::action('CompanyController@show', $id);
            } else {

                $redirectVariable = Redirect::action('CompanyController@edit', $id)->withErrors(['Error', 'The Message']);
            }
        }
        else
        {
            //otherwise return back to the company, with the same inputs, and the error messages.
            $redirectVariable = Redirect::action('CompanyController@edit', $id)->withInput()->withErrors($v->getErrors());
        }
        return $redirectVariable;
    }

}
