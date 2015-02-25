<?php

use App\Repositories\CompanyRepository;

class CompanyController extends \BaseController {

    public $companyRepo;

    public function __construct(CompanyRepository $companyRepo) {
        $this->companyRepo = $companyRepo;
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
    public function create()
    {
        return View::make('company.create');
    }
    
        /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store()
    {
        // Retrieve company information from user
        $companyInput['name'] = Input::get('company_name');
        $companyInput['contact_id'] = Input::get('primary_contact_1');
        
        //Store company
        $companyID = $this->createCompanyWith($companyInput);
 
        // If the family was successfully created
        if ($companyID > 0)
        {
            return Redirect::action('CompanyController@show', $companyID);

        }
        
        // Redirect user to newly created family's detail page
    }
    
    
    public function createCompanyWith($data)
    {
        $company = new Company($data);
        
        $this->companyRepo->saveCompany($company);
        
        return $company->id;
    }
}
