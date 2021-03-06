<?php

use App\Repositories\VolunteerInterestRepository;
use App\Repositories\VolunteerRepository;
use App\Repositories\InterestRepository;

class VolunteerInterestController extends \BaseController {

    public $volunteerRepo;
    public $volunteerInterestRepo;
    public $interestRepo;

    public function __construct(VolunteerInterestRepository $volunteerInterestRepo, VolunteerRepository $volunteerRepo, InterestRepository $interestRepo) {

        $this->volunteerRepo = $volunteerRepo;
        $this->volunteerInterestRepo = $volunteerInterestRepo;
        $this->interestRepo = $interestRepo;
    }

//    public function index($volunteerID) {
//
//        $volunteer = $this->volunteerRepo->getVolunteer($volunteerID);
//        $interests = $this->volunteerInterestRepo->getVolunteerInterest($volunteer);
//
//
//        return View::make('volunterInterest.index', array('volunteer' => $volunteer, 'volunteerInterest' => $interests));
//    }

    public function edit($volunteerID) {

        $volunteer = $this->volunteerRepo->getVolunteer($volunteerID);
        $volunteerInterests = $this->volunteerInterestRepo->getVolunteerInterests($volunteer->id);
        $interests = $this->interestRepo->getAllInterests();


        return View::make('volunteerinterest.edit', array('volunteer' => $volunteer, 'volunteerInterests' => $volunteerInterests, 'interests' => $interests));
    }

    public function create($volunteerID) {
        $interests = $this->interestRepo->getAllInterests();
        $volunteer = $this->volunteerRepo->getVolunteer($volunteerID);
//        $volunteerInterests = $this->volunteerInterestRepo->getVolunteerInterests($volunteerID);

        $intArray = array();

        foreach ($this->volunteerInterestRepo->getVolunteerInterests($volunteerID) as $vInt) {
            array_push($intArray, $vInt->interest->id);
        }
        return View::make('volunteerinterest.create', array('interests' => $interests, 'interestList' => $intArray,
                    'volunteer' => $volunteer));
    }

    public function store() {

        $volunteerInterests = array();
        for ($i = 0; $i < count(Input::get('volunteer_id')); $i++) {
            $volunteerInterests['volunteer_id'] = Input::get('volunteer_id')[$i];
            $volunteerInterests['interest_id'] = Input::get('interest')[$i];
            $volunteerInterests['comments'] = Input::get('comments')[$i];


            if (empty($volunteerInterests)) {
                throw new Exception('No Volunteer Interest info inserted.');
            }
            $this->storeInterestWith($volunteerInterests);
        }


        
     return Redirect::action('ContactController@show', $volunteerInterests['volunteer_id']);
    }

    /*
     * A function to update the interests for a volunteer 
     */

    public function update() {
        //Arrays that will contain the interests information
        $volunteerInterests = array();
        $infoArray = array();
        $formIDArray = array();
        //For every row on the form, add that row to a array containing the rows!
        for ($i = 0; $i < count(Input::get('row_id')); $i++) {
            //$volunteerItem['volunteer_id'] = Input::get('volunteer_id');
            $formIDArray[$i] = $volunteerInterests['id'] = Input::get('row_id')[$i];
            $volunteerInterests['volunteer_id'] = Input::get('volunteer_id')[$i];
            $volunteerInterests['interest_id'] = Input::get('interest')[$i];
            $volunteerInterests['comments'] = Input::get('comments')[$i];

            if (empty($volunteerInterests)) {
                throw new Exception('No Volunteer Interest info inserted.');
            }
            //Call our helper update method with the row information
            $this->updateInterestWith($volunteerInterests);
            //Add the row to an array so it won't be deleted later
            $infoArray[$i] = $volunteerInterests;
            
        }
        //  print_r($infoArray);
        //Get the static volunteer id, this never changes and we are making sure it won't
        $id = Input::get('contact');
        
        
      
        //Get all the volunteer interests from the database, will be used to delete.
        $interestArray = $this->volunteerInterestRepo->getVolunteerInterestsAsArray($id);
      
        //infoArray -> interests on the form (ones NOT to be deleted!)
        //$interestArray-> interests in the database
        //removedInterestsArray -> array of interests to remove from the database
        
//        $removedInterestsArray = array_diff($interestArray, $infoArray);
//        print_r($removedInterestsArray);
        
        foreach($interestArray as $interestEntry)
        {
            if(!in_array($interestEntry['id'], $formIDArray))
            {
               $affectedRows = $this->volunteerInterestRepo->
                            deleteVolunteerInterests($interestEntry['id']);  
            }
        }
       
   
        
//        //IF the database is not empty.
//        if (!empty($interestArray)) {
//            //For every interest in the database.
//            foreach ($interestArray as $interestEntry) {
//                
//              //  print_r($interestEntry['volunteer_id']);
//                //Haven't found an interest to keep yet.
//                $bFound = false;
//                //If the rows aren't empty on the form.
//                if (!empty($infoArray)) {
//                    //For every row on the form.
//                    foreach ($infoArray as $formEntry) {
//                     //    print_r($formEntry);
//                        //Is it the same as one in the database?
//                        if (strval($interestEntry['interest_id']) == $formEntry['interest_id']) {
//                            //If it is, we are keeping it.
//                            $bFound = true;
//                   //      print_r("_____x______");
//                        }
//                    }
//                }
//                //Row in the database doesn't exist on the form.
//                if (!$bFound) {
//
//                    //So we nuke it out of the database as well.
//                    $affectedRows = $this->volunteerInterestRepo->
//                            deleteVolunteerInterests($volunteerInterests['id']);
//                }
//            }
//        }
        
        
    return Redirect::action('ContactController@show', $id);
    }

    /*
     * Helper method to update interest row in the database
     */

    public function updateInterestWith($volunteerInterests) {
        $counter = 0;
        //Generic array of database field names.
        $fieldNames = array(
            '',
            'volunteer_id',
            'interest_id',
            'comments',
        );

        //Array to have the keys/values to update the row.
        $fieldUpdateValues = array();
        //For every value passed from the form entry.
        foreach ($volunteerInterests as $fieldValue) {
            //Add the key ($fieldNames[$counter]) and the value ($fieldValue)
            //To an array ($fieldUpdateValues) to be updated lower.
            if ($counter > 0) {
                $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
            }
            $counter++;
        }
        //Update the field/values in $fieldUpdateValues!!!
        $affectedRows = \VolunteerInterest::where('id', '=', $volunteerInterests['id'])->update($fieldUpdateValues);
    }

    /*
     * A function to store an interest.
     */

    public function storeInterestWith($volunteerInterest) {

        $interest = new VolunteerInterest($volunteerInterest);


        // Store interest
        $this->volunteerInterestRepo->saveVolunteerInterest($interest);

        return $interest->interest_id;
    }

}
