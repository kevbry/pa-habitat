<?php
use App\Repositories\ContactRepository;

class ContactController extends \BaseController {
    
        public $repo;

        public function __construct(ContactRepository $repo)
        {
            $this->repo = $repo;
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
            
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $contact = Contact::find($id);
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
