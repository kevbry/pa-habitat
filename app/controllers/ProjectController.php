<?php

use App\Repositories\ProjectRepository;
use App\Repositories\ProjectContactRepository;
use App\Repositories\ProjectInspectionRepository;
use App\Repositories\ProjectItemRepository;
use App\Repositories\VolunteerHoursRepository;
use App\Repositories\VolunteerRepository;
use App\Repositories\FamilyRepository;
use App\Repositories\ProjectRolesRepository;

class ProjectController extends \BaseController {

    public $projectRepo;
    public $projectContactRepo;
    public $projectInspectionRepo;
    public $projectItemRepo;
    public $volunteerHrsRepo;
    public $volunteerRepo;
    public $familyRepo;
    public $roleRepo;

    public function __construct(ProjectRepository $projectRepo, ProjectContactRepository $projectContactRepo, ProjectInspectionRepository $projectInspectionRepo, ProjectItemRepository $projectItemRepo, VolunteerHoursRepository $volunteerHrsRepo, VolunteerRepository $volunteerRepo, FamilyRepository $familyRepo, ProjectRolesRepository $roleRepo) {
        $this->projectRepo = $projectRepo;
        $this->projectContactRepo = $projectContactRepo;
        $this->projectInspectionRepo = $projectInspectionRepo;
        $this->projectItemRepo = $projectItemRepo;
        $this->volunteerHrsRepo = $volunteerHrsRepo;
        $this->volunteerRepo = $volunteerRepo;
        $this->familyRepo = $familyRepo;
        $this->roleRepo = $roleRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $sortby = Input::get('sortby');
        $order = Input::get('order');
// Retrieve all projects from the database

        if ($sortby && $order) {
            $projectList = $this->projectRepo->orderBy($sortby, $order);
        } else {
            $projectList = $this->projectRepo->getAllProjects();
        }

// Return that to the list view
        return View::make('project.index', compact('sortby', 'order'))->with('projects', $projectList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return View::make('project.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
//Retrieve Project information from user

        $projectInput['build_number'] = Input::get('build_number');
        $projectInput['name'] = Input::get('name');
        $projectInput['street_number'] = Input::get('street_number');
        $projectInput['postal_code'] = Input::get('postal_code');
        $projectInput['city'] = Input::get('city');
        $projectInput['province'] = Input::get('province');
        $projectInput['start_date'] = Input::get('start_date');
        $projectInput['enddate'] = Input::get('end_date');
        $projectInput['comments'] = Input::get('comments');
        $projectInput['building_permit_date'] = Input::get('building_permit_date');
        $projectInput['building_permit_number'] = Input::get('building_permit_number');
        $projectInput['mortgage_date'] = Input::get('mortgage_date');
        $projectInput['blueprint_plan_number'] = Input::get('blueprint_plan_number');
        $projectInput['blueprint_designer'] = Input::get('blueprint_designer');

        if($projectInput['start_date'] == null)
        {
            $dateTime = new DateTime();
            $result = $dateTime->format('Y-m-d');
          //  str
            $projectInput['start_date'] = $result;           
        }
        
        
        if (Input::get('family_id') > 0) {
            $projectInput['family_id'] = Input::get('family_id');
        }

//Create a validator, based on the contact validator I created.
        $v = new App\Libraries\validators\ProjectValidator($projectInput);
        //If the validator passes with the input provided, based on the rules in the validator class.
            if($v->passes())
            {
                //Assign returned value of a project id created to a variable.
                $projectID = $this->createProjectWith($projectInput);
                
                // Grab the id of the new project
                $id = $projectID;

                // Redirect to view the newly created project
                return Redirect::action('ProjectController@show', array($id));
            }       
            else
            {
                //otherwise return back to the contact, with the same inputs, and the error messages.
                return Redirect::action('ProjectController@create')->withInput()
                        ->withErrors($v->getErrors());
            }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $project = $this->projectRepo->getProject($id);
        $projectInspections = $this->projectInspectionRepo->getInspectionsForProject($id);
        $projectContacts = $this->projectContactRepo->getContactsForProject($id);
        $projectItems = $this->projectItemRepo->getItemsForProject($id);
        $volunteerHours = $this->volunteerHrsRepo->getHoursForProject($id);
        $volunteers = $this->volunteerRepo->getAllVolunteersNonPaginated();
        $family = $this->familyRepo->getFamily($project->family_id);
        $roles = $this->roleRepo->getAllRoles();

//        if (($projectContact = $this->projectContactRepo->getProjectContact($id)) != null) {
//            return View::make('project.show', array('project' => $project,
//                                'projectInspections' => $projectInspections,
//                                'projectItems' => $projectItems, 'volunteerhours' => $volunteerHours,
//                                'volunteers' => $volunteers, 'family' => $family))
//                            ->withProjectContact($projectContact);
//        } else {
        return View::make('project.show', array('project' => $project,
                    'projectInspections' => $projectInspections,
                    'projectItems' => $projectItems,
                    'volunteerhours' => $volunteerHours,
                    'volunteers' => $volunteers, 'family' => $family,
                    'projectContacts' => $projectContacts,
                    'roles' => $roles));
//        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $project = $this->projectRepo->getProject($id);
        //$family;
        if (( $family = $this->familyRepo->getFamily($project->family_id)) != null) {

            return View::make('project.edit')
                            ->withProject($project)
                            ->withFamily($family);
        }
        else {
                        return View::make('project.edit')
                            ->withProject($project);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
    
        if (Input::only('family')) {
            // Store values from the project form
            $projectInfo = Input::only(
                            'updated_at', 'family', 'build_number', 'street_number', 'postal_code', 'city', 'province', 'start_date', 'end_date', 'comments', 'building_permit_number', 'building_permit_date', 'mortgage_date', 'blueprint_plan_number', 'blueprint_designer');
            // Array of field names
            $fieldNames = array(
                'updated_at',
                'family_id',
                'build_number',
                'street_number',
                'postal_code',
                'city',
                'province',
                'start_date',
                'end_date',
                'comments',
                'building_permit_number',
                'building_permit_date',
                'mortgage_date',
                'blueprint_plan_number',
                'blueprint_designer');
        } else {
            // Store values from the project form
            $projectInfo = Input::only(
                            'updated_at', 'build_number', 'street_number', 'postal_code', 'city', 'province', 'start_date', 'end_date', 'comments', 'building_permit_number', 'building_permit_date', 'mortgage_date', 'blueprint_plan_number', 'blueprint_designer');
            // Array of field names
            $fieldNames = array(
                'updated_at',
                'build_number',
                'street_number',
                'postal_code',
                'city',
                'province',
                'start_date',
                'end_date',
                'comments',
                'building_permit_number',
                'building_permit_date',
                'mortgage_date',
                'blueprint_plan_number',
                'blueprint_designer');
        }

        //Used to count the field number based on the number of time through
        //the for each loop
        $counter = 0;
        //Creating an associate array for the update
        $fieldUpdateValues = array();

        //added key value pairs to the array
        foreach ($projectInfo as $fieldValue) {
            $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
            $counter++;
        }

        //updating the record in the contact table for the contact with the id passed in
        //var_dump($id);
        //var_dump($fieldUpdateValues);
        $affectedRows = Project::where('id', '=', $id)->update($fieldUpdateValues);
        //$affectedRows = 0;
        //var_dump($affectedRows);
        //use affected rows to dertirming if it was a success or not
        if ($affectedRows > 0) {
        // Redirect to view the updated contact info
            $redirectVariable = Redirect::action('ProjectController@show', $id);
        } else {
        //Redirect back to the edit page with an error message
            $redirectVariable = Redirect::action('ProjectController@edit', $id)->withErrors(['Error', 'The Message']);
        }
        // return to redirect
        return $redirectVariable;
    }

    /**
     * 
     * @param type $data
     * @return type ID
     */
    public function createProjectWith($data) {
        $project = new Project($data);

        $this->projectRepo->saveProject($project);

        return $project->id;
    }

    /**
     * 
     * @param type $data
     */
//    public function createProjectContactWith($data) {
//        $projectContact = new ProjectContact($data);
//
//        $this->projectContactRepo->saveProjectContact($projectContact);
//        
//    }
}
