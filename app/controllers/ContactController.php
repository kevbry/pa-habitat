<?php
use App\Repositories\ContactRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\VolunteerRepository;
use App\Repositories\DonorRepository;

class ContactController extends \BaseController {
    
        public $companyRepo;
        public $contactRepo;
        public $donorRepo;
        public $volunteerRepo;

        public function __construct(ContactRepository $contactRepo, VolunteerRepository $volunteerRepo, CompanyRepository $companyRepo, DonorRepository $donorRepo)
        {
            $this->companyRepo = $companyRepo;
            $this->contactRepo = $contactRepo;
            $this->donorRepo = $donorRepo;
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
            // Check if the contact being created is a donor
            $donorStatus = Input::has('is_donor');
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
            
            // Add the contact as a donor if specified -- Should probably be moved somewhere else
            if ($donorStatus)
            {                
                // Assign the contact
                $donorValues['id'] = $id;
                
                $donor = new Donor($donorValues);
                
                $this->donorRepo->saveDonor($donor);
            }
            
            // Add the contact as a volunteer if specified -- Should probably be moved somewhere else
            if ($volunteerStatus)
            {
                $volunteerValues['active_status'] = Input::has('active_status') ? 1 : 0;
                $volunteerValues['last_attended_safety_meeting_date'] = Input::get('last_attended_safety_meeting_date');
                // Assign the contact
                $volunteerValues['id'] = $id;
                
                $volunteer = new Volunteer($volunteerValues);
                
                $this->volunteerRepo->saveVolunteer($volunteer);
            }
            
            // Add the contact as a company if specified -- Should probably be moved somewhere else
            // Checkbox doesnt work, the if statement.
            if (Input::has('company_name'))
            {
                // Store values from the company portion of contact form
                $companyValues = Input::only('company_name');
                
                // Assign the company
                $companyValues['contact_id'] = $id;
                
                $company = new Company($companyValues);
                
                $this->companyRepo->saveCompany($company);
           }
           
            //assign a redirect variable
            $redirectVariable = Redirect::action('ContactController@show',array($id));
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
            $contact = $this->contactRepo->getContact($id);
            $volunteer = $this->volunteerRepo->getVolunteer($id);
            
            return View::make('contact.show')
                    ->withContact($contact)
                    ->withVolunteer($volunteer);
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
