<?php
use App\Repositories\FamilyRepository;
use App\Repositories\FamilyContactRepository;
use App\Repositories\VolunteerHoursRepository;
/**
 * Description of FamilyController
 *
 * @author cst222
 */
class FamilyController extends \BaseController
{
    public $familyRepo;
    public $familyContactRepo;
    public $volunteerHoursRepo;
    
    public function __construct(FamilyRepository $familyRepo, 
            FamilyContactRepository $familyContactRepo, VolunteerHoursRepository $volunteerHoursRepo)
    {
        // Assigning Dependancies
        $this->familyRepo = $familyRepo;
        $this->familyContactRepo = $familyContactRepo;
        $this->volunteerHoursRepo = $volunteerHoursRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve all families from the database
 
         $sortby = Input::get('sortby');
            $order = Input::get('order');

            if ($sortby && $order) {

               $familyList = $this->familyRepo->orderBy($sortby, $order);
            } else {
                $familyList = $this->familyRepo->getAllFamilies();
            }
           
            // Return that to the list view
            return View::make('family.index',compact('sortby','order'))->with('families', $familyList);
       
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('family.create');
    }
        
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Retrieve family information from user
        $familyInput['name'] = Input::get('family_name');
        $familyInput['status'] = 'Pending';
        $familyInput['comments'] = Input::get('comments');

        // Capture FamilyContact entries to store in database
        $contactArray = array_keys(Input::all());
        
        // Pull any array key that references a contact id
        $contactRegEx = '/[a-z_]*contact_\d/';
        
        $inputStringArray = array();
        preg_match_all($contactRegEx, implode($contactArray, " "), $inputStringArray);
        
        //Store family contacts
        $familyID = $this->createFamilyWith($familyInput);
 
        // If the family was successfully created
        if ($familyID > 0)
        {
            // Set the family ID
            $familyContactInput['family_id'] = $familyID;
            
            // For each contact in the family
            foreach($inputStringArray[0] as $contactKey)
            {
                // Get the contact_id
                $familyContactInput['contact_id'] = Input::get($contactKey);
                
                // Make sure to only create contacts that the user has passed in
                if ( ! empty($familyContactInput['contact_id']))
                {
                    // Determine if the contact is a primary family member or not
                    $familyContactInput['primary'] = strpos($contactKey, 'primary') !== false ? true : false;
                    $familyContactInput['currently_active'] = true;

                    // Add the record to the database
                    $this->createFamilyContactWith($familyContactInput);                       
                }
            }
        }
        
        // Redirect user to newly created family's detail page
        return Redirect::action('FamilyController@show', $familyID);
    }
    
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $family = $this->familyRepo->getFamily($id);
        $familyContacts = $this->familyContactRepo->getContactsInFamily($id);
        
        $familyContactHours = $this->volunteerHoursRepo->getHoursForFamily($id);

        $familyInformation = array($family, $familyContacts, $familyContactHours);
        
        return View::make('family.show')->with('family', $familyInformation);
    }
    
    public function createFamilyWith($data)
    {
        $family = new Family($data);
        
        $this->familyRepo->saveFamily($family);
        
        return $family->id;
    }
    
    public function createFamilyContactWith($data)
    {
        $familyContact = new FamilyContact($data);
        
        $this->familyContactRepo->saveFamilyContact($familyContact);
    }
}
