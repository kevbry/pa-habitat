<?php
use App\Repositories\FamilyRepository;
use App\Repositories\FamilyContactRepository;
/**
 * Description of FamilyController
 *
 * @author cst222
 */
class FamilyController extends \BaseController
{
    public $familyRepo;
    public $familyContactRepo;
    
    public function __construct(FamilyRepository $familyRepo, FamilyContactRepository $familyContactRepo)
    {
        // Assigning Dependancies
        $this->familyRepo = $familyRepo;
        $this->familyContactRepo = $familyContactRepo;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve all families from the database
        $familyList = $this->familyRepo->getAllFamilies();

        // Return that to the list view
        return View::make('family.index')->with('families', $familyList);
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
        
        $numContacts = sizeof($inputStringArray[0]);
        
        //Store family contacts
        $familyID = $this->createFamilyWith($familyInput);
        
        
        if ($familyID > 0)
        {
            $familyContactInput['family_id'] = $familyID;
            
            foreach($inputStringArray[0] as $contactKey)
            {
                $familyContactInput['contact_id'] = Input::get($contactKey);
                    
                if ( ! empty($familyContactInput['contact_id']))
                {
                    $familyContactInput['primary'] = strpos($contactKey, 'primary') !== false ? true : false;
                    $familyContactInput['currently_active'] = true;

                    $this->createFamilyContactWith($familyContactInput);                       
                }
            }
        }
        
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
        $familyContacts = $this->familyContactRepo->getActiveContactsInFamily($id);

        $happyFamily = array($family, $familyContacts);
        
        return View::make('family.show')->with('family', $happyFamily);
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
    
    private function createFamilyWith($data)
    {
        $family = new Family($data);
        
        $this->familyRepo->saveFamily($family);
        
        return $family->id;
    }
    
    private function createFamilyContactWith($data)
    {
        $familyContact = new FamilyContact($data);
        
        $this->familyContactRepo->saveFamilyContact($familyContact);
    }
}
