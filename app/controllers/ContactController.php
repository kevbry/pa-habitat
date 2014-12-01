<?php
use App\Repositories\ContactRepository;
use App\Repositories\VolunteerRepository;

class ContactController extends \BaseController {
    
        public $contactRepo;
        public $volunteerRepo;

        public function __construct(ContactRepository $contactRepo, VolunteerRepository $volunteerRepo)
        {
            $this->contactRepo = $contactRepo;
            $this->volunteerRepo = $volunteerRepo;
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
            // Check if the contact being created is a volunteer
            $volunteerStatus = Input::has('is_volunteer');
            
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
            $this->contactRepo->saveContact($contact);
            
            // Grab the id of the new contact
            $id = $contact->id;
            
            // Add the contact as a volunteer if specified -- Should probably be moved somewhere else
            if ($volunteerStatus)
            {
                // Store values from the volunteer portion of contact form
                $volunteerValues = Input::only('active_status', 'last_attended_safety_meeting_date');
                
                $volunteerValues['active_status'] = Input::has('active_status') ? 1 : 0;
                
                // Assign the contact
                $volunteerValues['id'] = $id;
                
                $volunteer = new Volunteer($volunteerValues);
                
                $this->volunteerRepo->saveVolunteer($volunteer);
            }
            
            // Redirect to view the newly created contact
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
