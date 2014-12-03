<?php
use App\Repositories\ContactRepository;
use App\Repositories\CompanyRepository;

class ContactController extends \BaseController {
    
        public $repo;
        public $companyRepo;

        public function __construct(ContactRepository $repo, CompanyRepository $companyRepo)
        {
            $this->repo = $repo;
            $this->companyRepo = $companyRepo;
        }
    

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            // Retrieve all contacts from the database
            $contactList = $this->repo->getAllContacts();
            
            // Return that to the list view
            return View::make('contact.index')->with('contacts', $contactList);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('contact.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
             // Check a company is being created
            $companyStatus = Input::has('company_add');
            
            // Store values from the contact form
            $contactValues = Input::only('first_name', 
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
            
            // Create a new contact object to store in the database
            $contact = new Contact($contactValues);
            
            // Store contact
            $this->repo->saveContact($contact);
            
            // Grab the id of the new contact
            $id = $contact->id;
                        
            //assign a redirect varibale
            $redirectVariable = Redirect::action('ContactController@show',array($id));
            
            // Add the contact as a volunteer if specified -- Should probably be moved somewhere else
            // Checkbox dosent work, the if statement.
            if ($companyStatus)
            {
                // Store values from the company portion of contact form
                $companyValues = Input::only('company_name');
                
                // Assign the company
                $companyValues['contact_id'] = $id;
                
                $company = new Company($companyValues);
                
               $this->companyRepo->saveCompany($company);
               
                // Grab the id of the new contact
                $id = $company->id;
               $redirectVariable = Redirect::action('ContactController@show',array($id));
           }
            // Redirect to view the newly created contact
            return $redirectVariable;
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
