<?php

use App\Repositories\ProjectInspectionRepository;
use App\Repositories\ProjectRepository;
/**
 * Specifies a controller for the ProjectInspection class and functionality.
 */
class ProjectInspectionController extends \BaseController {

    public $projectRepo;
    public $projectInspectionRepo;

    public function __construct(ProjectInspectionRepository $projectInspectionRepo, ProjectRepository $projectRepo) 
    {
        $this->projectRepo = $projectRepo;
        $this->projectInspectionRepo = $projectInspectionRepo;
    }
    /**
     * Displays a list of all project inspections.
     */
    public function index($projectId) 
    {
        $project = $this->projectRepo->getProject($projectId);
        $projectInspections = $this->projectInspectionRepo->getInspectionsForProject($projectId);

        return View::make('projectinspection.index', array('project' => $project, 'projectInspections' => $projectInspections));
    }
    
    /**
     * Displays a page that allows for the creation of project inspections.
     */
    public function create($projectId) 
    {
        $project = $this->projectRepo->getProject($projectId);
        return View::make('projectinspection.create', array('id' => $projectId, 
            'project' => $project));
    }
    
    /**
     * Stores project inspections in the database.
     */
    public function store() {
        $projectInspection = array();
        for ($i = 0; $i < count(Input::get('type')); $i++) 
        {
            $projectInspection['project_id'] = Input::get('project_id');
            $projectInspection['mandatory'] = Input::get('mandatory')[$i];
            $projectInspection['date'] = Input::get('date')[$i];
            $projectInspection['type'] = Input::get('type')[$i];
            $projectInspection['pass'] = Input::get('pass')[$i];
            $projectInspection['comments'] = Input::get('comments')[$i];

            if (empty($projectInspection)) {
                throw new Exception('No Project Inspection info inserted.');
            }
            $this->storeInspectionWith($projectInspection);
        }

        return Redirect::action('ProjectInspectionController@index', $projectInspection['project_id']);

    }

    /*
     * Stores a specific inspection with a specific project.
     */
    public function storeInspectionWith($projectInspection) {

        $inspection = new ProjectInspection($projectInspection);

        // Store inspection
        $this->projectInspectionRepo->saveProjectInspection($inspection);

        return $inspection->id;
    }
    
    public function edit($projectId) {
        $project = $this->projectRepo->getProject($projectId);
        $projectInspections = $this->projectInspectionRepo->getInspectionsForProjectNonPaginated($projectId);
        $inspectionPasses = array(1=>'PASS', 0=>'FAIL');
        $mandatoryTypes = array(1 => "YES", 0=>'NO');
        return View::make('projectinspection.edit', array('project' => $project, 'projectInspections' => $projectInspections,
            'inspectionPasses' => $inspectionPasses, 'mandatoryTypes' => $mandatoryTypes));
    }
    /*
     * A function to update the items for a project :D
     */
    public function update() {
        //Arrays that will contain the inspections information
        $projectInspection = array();
        $infoArray = array();
        //For every row on the form, add that row to a array containing the rows!
        for ($i = 0; $i < count(Input::get('id')); $i++) {
            //$projectInspection['project_id'] = Input::get('project_id');
            $projectInspection['id'] = Input::get('id')[$i];
            $projectInspection['mandatory'] = Input::get('mandatory')[$i];
            $projectInspection['date'] = Input::get('date')[$i];
            $projectInspection['type'] = Input::get('type')[$i];
            $projectInspection['pass'] = Input::get('pass')[$i];
            $projectInspection['comments'] = Input::get('comments')[$i];

            if (empty($projectInspection)) {
                throw new Exception('No Project Inspection info inserted.');
            }
            //Call our helper update method with the row information
            $this->updateInspectionWith($projectInspection);
            //Add the row to an array so it won't be deleted later
            $infoArray[$i] = $projectInspection;
        }
        //Get the static project id, this never changes and we are making sure it won't
        $id = Input::get('project_id');
        //Get all the project inspections from the database, will be used to delete.
        $inspectionArray = $this->projectInspectionRepo->getInspectionsForProjectNonPaginated($id);
        //IF the database is not empty.
        if(!empty($inspectionArray))
        {
            //For every inspection in the database.
            foreach($inspectionArray as $inspectionEntry)
            {
                //Haven't found an inspection to keep yet.
                $bFound = false;
                //If the rows aren't empty on the form.
                if(!empty($infoArray))
                {
                    //For every row on the form.
                    foreach($infoArray as $formEntry)
                    {
                        //Is it the same as one in the database?
                        if( strval($inspectionEntry['id']) == $formEntry['id'] )
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
                    $affectedRows = ProjectInspection::where('id','=',$inspectionEntry['id'])->delete();
                }
            }     
        }
        //Redirect back to index for project inspections
        return Redirect::action('ProjectInspectionController@index', $id);
    }
        /*
     * Helper method to update inspection row in the database
     */
    public function updateInspectionWith($projectInspection) {
        $counter = 0;
        //Generic array of database field names.
        $fieldNames = array(
            //'project_id',
            'id',
            'mandatory',
            'date',
            'type',
            'pass',
            'comments'
        );
        //Array to have the keys/values to update the row.
        $fieldUpdateValues = array();
        //For every value passed from the form entry.
        foreach($projectInspection as $fieldValue)
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
        $affectedRows = ProjectInspection::where('id','=',$projectInspection['id'])->update($fieldUpdateValues);
    }
}