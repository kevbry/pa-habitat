<?php
use App\Repositories\CompanyRepository;

/**
 * 
 */
class CompanyController extends \BaseController
{
    public $repo;
    
    /**
     * Purpose : Constructor of the CompanyController
     * @param \App\Repositories\CompanyRepository $repo
     */
    public function __construct(CompanyRepository $repo) 
    {
        $this->repo = $repo;
    }
    
    
    /**
     * Display a listening of the resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('company.create');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve all contacts from the database
        $companyList = $this->repo->getAllCompanies();

        // Return that to the list view
        return View::make('company.index')->with('companies', $companyList);
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            //we have to retrieve the contact ID for a company
            $contactId = $contact->id;
            $values = Input::only('Company_name', 
                                    'first_name', 
                                    'last_name', 
                                    'email_address',
                                    'cell_phone', 
                                    'work_phone', 
                                    'street_address', 
                                    'city', 
                                    'province', 
                                    'postal_code', 
                                    'country', 
                                    'comments');
            $company = new Company($values);
            $this->repo->saveCompany($company,$values);
            $id = $company->id;
            return Redirect::action('CompanyController@show',array($id));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $company = $this->repo->getCompany($id);
            return View::make('company.show')->withCompany($company);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
