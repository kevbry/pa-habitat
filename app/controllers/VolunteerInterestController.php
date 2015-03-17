<?php

use App\Repositories\VolunteerInterestRepository;
use App\Repositories\VolunteerRepository;

class VolunteerInterestController extends \BaseController {
    
    
 public $volunteerRepo;
 public $volunteerID;

    public function __construct(VolunteerInterestRepository $volunteerInterestRepo, VolunteerRepository $volunteerRepo) {

        $this->volunteerRepo = $volunteerRepo;
        $this->volunteerInterestRepo = $volunteerInterestRepo;
    }

    public function index($volunteerID) {

        $volunteer = $this->volunteerRepo->getVolunteer($volunteerID);
        $interests = $this->volunteerInterestRepo->getVolunteerInterest($volunteer);

        return View::make('volunterInterest.index', array('volunteer' => $volunteer, 'volunteerInterest' => $interests));
    }
    
    public function create($volunteerID) {
        $interestdescriptions = \Interest::$description;
       $volunteer = $this->volunteerRepo->getVolunteer($volunteerID);
        return View::make('volunterInterest.create', array('id' => $volunteerID, 'interestDescriptions' => $interestdescriptions,
                    'volunteer' => $volunteer));
    }

    public function store() {
        
        $projectItem = array();
        for ($i = 0; $i < count(Input::get('project_id')); $i++) {
            $projectItem['project_id'] = Input::get('project_id')[$i];
            $projectItem['item_type'] = Input::get('item_type')[$i];
            $projectItem['manufacturer'] = Input::get('manufacturer')[$i];
            $projectItem['model'] = Input::get('model')[$i];
            $projectItem['serial_number'] = Input::get('serial_number')[$i];
            $projectItem['vendor'] = Input::get('vendor')[$i];
            $projectItem['comments'] = Input::get('comments')[$i];

            if (empty($projectItem)) {
                throw new Exception('No Project Item info inserted.');
            }
            $this->storeItemWith($projectItem);
        }

        return Redirect::action('ProjectItemController@index', $projectItem['project_id']);

    }
    
    public function edit($projectId) {
        $itemTypes = \ProjectItem::$types;
        $project = $this->projectRepo->getProject($projectId);
        $projectItems = $this->projectItemRepo->getItemsForProjectNonPaginated($projectId);

        return View::make('projectitem.edit', array('project' => $project, 'itemTypes' => $itemTypes, 'projectItems' => $projectItems));
    }
    /*
     * A function to update the items for a project :D
     */
    public function update() {
        //Arrays that will contain the items information
        $projectItem = array();
        $infoArray = array();
        //For every row on the form, add that row to a array containing the rows!
        for ($i = 0; $i < count(Input::get('id')); $i++) {
            //$projectItem['project_id'] = Input::get('project_id');
            $projectItem['id'] = Input::get('id')[$i];
            $projectItem['item_type'] = Input::get('item_type')[$i];
            $projectItem['manufacturer'] = Input::get('manufacturer')[$i];
            $projectItem['model'] = Input::get('model')[$i];
            $projectItem['serial_number'] = Input::get('serial_number')[$i];
            $projectItem['vendor'] = Input::get('vendor')[$i];
            $projectItem['comments'] = Input::get('comments')[$i];

            if (empty($projectItem)) {
                throw new Exception('No Project Item info inserted.');
            }
            //Call our helper update method with the row information
            $this->updateItemWith($projectItem);
            //Add the row to an array so it won't be deleted later
            $infoArray[$i] = $projectItem;
        }
        //Get the static project id, this never changes and we are making sure it won't
        $id = Input::get('project_id');
        //Get all the project items from the database, will be used to delete.
        $itemArray = $this->projectItemRepo->getItemsForProjectNonPaginated($id);
        //IF the database is not empty.
        if(!empty($itemArray))
        {
            //For every item in the database.
            foreach($itemArray as $itemEntry)
            {
                //Haven't found an item to keep yet.
                $bFound = false;
                //If the rows aren't empty on the form.
                if(!empty($infoArray))
                {
                    //For every row on the form.
                    foreach($infoArray as $formEntry)
                    {
                        //Is it the same as one in the database?
                        if( strval($itemEntry['id']) == $formEntry['id'] )
                        {
                            //If it is, we are keeping it.
                            $bFound = true;
                        }
                    }
                }
                //Row in the database doesn't exist on the form.
                if(!$bFound)
                {
                    //So we nuke it out of the database as well.
                    $affectedRows = ProjectItem::where('id','=',$itemEntry['id'])->delete();
                }
            }     
        }
        //Redirect back to index for project items
        return Redirect::action('ProjectItemController@index', $id);
    }
    /*
     * Helper method to update item row in the database
     */
    public function updateItemWith($projectItem) {
        $counter = 0;
        //Generic array of database field names.
        $fieldNames = array(
            //'project_id',
            'id', 
            'item_type',
            'manufacturer',
            'model',
            'serial_number', 
            'vendor',
            'comments'
        );
        //Array to have the keys/values to update the row.
        $fieldUpdateValues = array();
        //For every value passed from the form entry.
        foreach($projectItem as $fieldValue)
        {
            //Don't update the first one, it's an id to be used lower as a primary key.
            if($counter != 0)
            {
                //Add the key ($fieldNames[$counter]) and the value ($fieldValue)
                //To an array ($fieldUpdateValues) to be updated lower.
                $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
            }
            $counter++; 
        }
        //Update the field/values in $fieldUpdateValues!!!
        $affectedRows = ProjectItem::where('id','=',$projectItem['id'])->update($fieldUpdateValues);
    }
    /*
     * A function to store an item.
     */
    public function storeItemWith($projectItem) {

        $item = new ProjectItem($projectItem);

        // Store item
        $this->projectItemRepo->saveProjectItem($item);

        return $item->id;
    }   
}
