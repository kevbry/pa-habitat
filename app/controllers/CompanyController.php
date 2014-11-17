<?php

use App\Repositories\CompanyRepository;

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
     * Show the form for creating a new resource.
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
        return View::make('company.index')->with('company', $companyList);
    }


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $values = Input::only('first_name', 
                                    'last_name', 
                                    'email_address',
                                    'home_phone', 
                                    'cell_phone', 
                                    'work_phone', 
                                    'street_address', 
                                    'city', 
                                    'province', 
                                    'postal_code', 
                                    'country', 
                                    'comments');
            $contact = new Contact($values);
            $this->repo->saveContact($contact,$values);
            $id = $contact->id;
            return Redirect::action('ContactController@show',array($id));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $contact = $this->repo->getContact($id);
            return View::make('contact.show')->withContact($contact);
            
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
