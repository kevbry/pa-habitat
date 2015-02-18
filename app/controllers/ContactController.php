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
            // Retrieve  contacts from the database
            
            $sortby = Input::get('sortby');
            $order = Input::get('order');

            if ($sortby && $order) {

               $contactList = $this->contactRepo->orderBy($sortby, $order);
            } else {
                $contactList = $this->contactRepo->getAllContacts();
            }
           
            // Return that to the list view
            return View::make('contact.index',compact('sortby','order'))->with('contacts', $contactList);
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
            
            // Check if the contact being created is a company
            $companyStatus = Input::has('company_name');
            
            // Store values from the contact form
            $contactInfo = Input::only('first_name', 
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
            
            // Store the contact
            $id = $this->storeContactWith($contactInfo);
            
            // Add the contact as a donor if specified
            if ($donorStatus)
            {                
                // Assign the contact
                $donorInfo['id'] = $id;
                
                // Store Donor
                $this->storeDonorWith($donorInfo);

            }
            
            // Add the contact as a volunteer if specified
            if ($volunteerStatus)
            {
                // Get volunteer information
                $volunteerInfo['active_status'] = Input::has('active_status') ? 1 : 0;
                $volunteerInfo['last_attended_safety_meeting_date'] = Input::get('last_attended_safety_meeting_date');
                
                // Assign the contact id
                $volunteerInfo['id'] = $id;
                
                // Store Volunteer
                $this->storeVolunteerWith($volunteerInfo);
            }
            
            // Add the contact as a company if specified
            if ($companyStatus)
            {
                //Convert web form keys/values to match database keys/values
                $companyData = Input::only('company_name');
                $companyName['name'] = $companyData['company_name'];
                // Store values from the company portion of contact form
                $companyInfo = $companyName;
                
                // Assign the contact's id
                $companyInfo['contact_id'] = $id;
                
                // Store Company
                $this->storeCompanyWith($companyInfo);

           }
           
            //assign a redirect variable
            $redirectVariable = Redirect::action('ContactController@show', $id);
            // Redirect to view the newly created contact
            return $redirectVariable;
	}

        public function storeDonorWith($donorInfo)
        {               
            $donor = new Donor($donorInfo);
                
            $this->donorRepo->saveDonor($donor);
        }
        
        public function storeContactWith($contactInfo)
        {
            $contact = new Contact($contactInfo);
            
            // Store contact
            $this->contactRepo->saveContact($contact);
            
            return $contact->id;
        }
        
        public function storeVolunteerWith($volunteerInfo)
        {
            $volunteer = new Volunteer($volunteerInfo);

            $this->volunteerRepo->saveVolunteer($volunteer);
        }
        
        public function storeCompanyWith($companyInfo)
        {
            $company = new Company($companyInfo);
                
            $this->companyRepo->saveCompany($company);
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
            $contact = $this->contactRepo->getContact($id);
            $volunteer = $this->volunteerRepo->getVolunteer($id);
            return View::make('contact.edit')
                    ->withContact($contact)
                    ->withVolunteer($volunteer);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
            // Store values from the contact form
            $contactInfo = Input::only(
                        'first_name',
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
            // Array of field names
            $fieldNames = array(
                        'first_name',
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
            
            $volunteerPassed = Input::has('is_volunteer');
            $volunteerInfo = [];
            
            if($volunteerPassed)
            {
                $volunteerInfo['active_status'] = Input::has('active_status') ? 1 : 0;
                $volunteerInfo['last_attended_safety_meeting_date'] = Input::get('last_attended_safety_meeting_date');
                // Assign the contact id
                $volunteerInfo['id'] = $id;
                
                $this->storeVolunteerWith($volunteerInfo);         
            }
            else
            {
                $volunteerInfo['active_status'] = Input::has('active_status') ? 1 : 0;
                $volunteerInfo['last_attended_safety_meeting_date'] = Input::get('last_attended_safety_meeting_date');
                Volunteer::where('id','=',$id)->update($volunteerInfo);
            }

            //Used to count the field number based on the number of time through
            //the for each loop
            $counter = 0;
            //Creating an associate array for the update
            $fieldUpdateValues = array();

            //added key value pairs to the array
            foreach($contactInfo as $fieldValue)
            {
                $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
                $counter++;
            }
            
            //updating the record in the contact table for the contact with the id passed in
            
            $affectedRows = Contact::where('id','=',$id)->update($fieldUpdateValues);

            //var_dump($affectedRows);
            //use affected rows to dertirming if it was a success or not
            if($affectedRows > 0)
            {
                // Redirect to view the updated contact info
                $redirectVariable = Redirect::action('ContactController@show', $id);
            }
            else
            {
                //Redirect back to the edit page with an error message
                $redirectVariable = Redirect::action('ContactController@edit', $id)->withErrors(['Error', 'The Message']);
            }
            // return to redirect
            return $redirectVariable;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//boom
	}
}
