<?php
use App\Repositories\ContactRepository;
use App\Repositories\DonorRepository;

class ContactController extends \BaseController {
    
        public $contactRepo;
        public $donorRepo;
        
        public function __construct(ContactRepository $contactRepo, DonorRepository $donorRepo)
        {
            $this->contactRepo = $contactRepo;
            $this->donorRepo = $donorRepo;
        }
    

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            // Retrieve all contacts from the database
            $contactList = $this->contactRepo->getAllContacts();
            
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
            // Check if the contact being created is a donor
            $donorStatus = Input::has('is_donor');

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
            $contact = new Contact($contactValues);
            $this->contactRepo->saveContact($contact,$contactValues);
            $id = $contact->id;
            
            // Add the contact as a volunteer if specified -- Should probably be moved somewhere else
            if ($donorStatus)
            {
                // Store values from the donor portion of contact form
                $donorValues = Input::only('business_name');
                
                // Assign the contact
                $donorValues['id'] = $id;
                
                $donor = new Donor($donorValues);
                
                $this->donorRepo->saveDonor($donor);
            }
            
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
            $contact = $this->contactRepo->getContact($id);
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
