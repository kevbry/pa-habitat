<?php

use App\Repositories\ProjectRepository;
use App\Repositories\ProjectContactRepository;
use App\Repositories\ProjectInspectionRepository;
use App\Repositories\ProjectItemRepository;

class ProjectController extends \BaseController {
        public $projectRepo;
        public $projectContactRepo;
        public $projectInspectionRepo;
        public $projectItemRepo;

        public function __construct(ProjectRepository $projectRepo, 
                ProjectContactRepository $projectContactRepo,
                ProjectInspectionRepository $projectInspectionRepo,
                ProjectItemRepository $projectItemRepo)
        {
            $this->projectRepo = $projectRepo;
            $this->projectContactRepo = $projectContactRepo;
            $this->projectInspectionRepo = $projectInspectionRepo;
            $this->projectItemRepo = $projectItemRepo;            
        }
            

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $sortby = Input::get('sortby');
            $order = Input::get('order');
            // Retrieve all projects from the database

            if ($sortby && $order) {
               $projectList = $this->projectRepo->orderBy($sortby, $order);
            } else {
                $projectList = $this->projectRepo->getAllProjects();
            }

            // Return that to the list view
            return View::make('project.index',compact('sortby','order'))->with('projects', $projectList);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('project.create');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            //Retrieve Project information from user
            
            $projectInput['build_number'] = Input::get('build_number');
            $projectInput['name'] = Input::get('name');
            $projectInput['street_number'] = Input::get('street_number');
            $projectInput['postal_code'] = Input::get('postal_code');
            $projectInput['city'] = Input::get('city');
            $projectInput['province'] = Input::get('province');
            $projectInput['start_date'] = Input::get('start_date');
            $projectInput['end_date'] = Input::get('end_date');
            $projectInput['comments'] = Input::get('comments');
            $projectInput['building_permit_date'] = Input::get('building_permit_date');
            $projectInput['building_permit_number'] = Input::get('building_permit_number');
            $projectInput['mortgage_date'] = Input::get('mortgage_date');
            $projectInput['blueprint_plan_number'] = Input::get('blueprint_plan_number');
            $projectInput['blueprint_designer'] = Input::get('blueprint_designer');
             
            if(Input::get('family_id') > 0)
            {
                $projectInput['family_id'] = Input::get('family_id');
            }
            
            
            //Assign returned value of a project id created to a variable.
            $projectID = $this->createProjectWith($projectInput);
            
            // Store values from the contact form
//            $projectValues = Input::only('name');
//            
            // Create a new contact object to store in the database
            //$project = new Project($projectValues);
//            
//            // Store contact
//            $this->projectRepo->saveProject($project);
//            
            // Grab the id of the new contact
            $id = $projectID;
//
//           

            // Redirect to view the newly created contact
            return Redirect::action('ProjectController@show',array($id));
	}
        
        	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $project = $this->projectRepo->getProject($id);
            $projectInspections = $this->projectInspectionRepo->getInspectionsForProject($id);
            $projectItems = $this->projectItemRepo->getItemsForProject($id);
            if(($projectContact = $this->projectContactRepo->getProjectContact($id)) != null)
            {
                return View::make('project.show', array('project' => $project,
                'projectInspections' => $projectInspections,
                'projectItems' => $projectItems))
                        ->withProjectContact($projectContact);
            }
            else
            {
                return View::make('project.show', array('project' => $project,
                'projectInspections' => $projectInspections,
                'projectItems' => $projectItems));
            }
                

            
	}

  	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
            $project = $this->projectRepo->getProject($id);
            if(($projectContact = $this->projectContactRepo->getProjectContact($id)) != null)
            {
                return View::make('project.edit')
                        ->withProject($project)
                        ->withProjectContact($projectContact);
            }
            else
            {
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
        public function update($id) 
        {
            //getting values to update the project coordinator
            $projectCoordinatorInfo = [];
            $projectCoordinatorInfo['contact_id'] = Input::only('project_coordinator');
            $projectCoordinatorInfo['role'] = "Project Coordinator";
            $projectCoordinatorInfo['updated_at'] = Input::only('updated_at');
            $hasEntry = ProjectContact::where('project_id','=',$id)->first();
            
            var_dump($hasEntry);
            if($hasEntry == null && $projectCoordinatorInfo['contact_id'] != null)
            {
                $projectCoordinatorInfo['project_id'] = $id;
                $projectCoordinatorInfo['created_at'] = Input::only('updated_at');
                var_dump($projectCoordinatorInfo);
                ProjectContact::insert($projectCoordinatorInfo);
            }
            else if($hasEntry != null && $projectCoordinatorInfo['contact_id'] == null)
            {
                ProjectContact::where('project_id','=',$id)->delete();
            }
            else
            {
                ProjectContact::where('project_id','=',$id)->update($projectCoordinatorInfo);
            }
            
            
            
            // Store values from the project form
            $projectInfo = Input::only(
                        'updated_at',
                        'family',
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
            

            
            //Used to count the field number based on the number of time through
            //the for each loop
            $counter = 0;
            //Creating an associate array for the update
            $fieldUpdateValues = array();
            
            //added key value pairs to the array
            foreach($projectInfo as $fieldValue)
            {
                $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
                $counter++;
            }

            //updating the record in the contact table for the contact with the id passed in
            var_dump($id);
            var_dump($fieldUpdateValues);
            $affectedRows = Project::where('id','=',$id)->update($fieldUpdateValues);
            //$affectedRows = 0;
            //var_dump($affectedRows);
            //use affected rows to dertirming if it was a success or not
            if($affectedRows > 0)
            {
                // Redirect to view the updated contact info
                $redirectVariable = Redirect::action('ProjectController@show', $id);
            }
            else
            {
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
        public function createProjectWith($data) 
        {
            $project = new Project($data);
            
            $this->projectRepo->saveProject($project);
            
            return $project->id;
        }
        
        /**
         * 
         * @param type $data
         */
        public function createProjectContactWith($data)
        {
            $projectContact = new ProjectContact($data);
            
            $this->projectContactRepo->saveProjectContact($projectContact);            
        }


}
