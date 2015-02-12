<?php

use App\Repositories\ProjectRepository;
use App\Repositories\ProjectContactRepository;
use App\Repositories\ProjectItemRepository;

class ProjectController extends \BaseController {
        public $projectRepo;
        public $projectContactRepo;
        public $projectItemRepo;


        public function __construct(ProjectRepository $projectRepo, ProjectContactRepository $projectContactRepo, 
                ProjectItemRepository $projectItemRepo )
        {
            $this->projectRepo = $projectRepo;
            $this->projectContactRepo = $projectContactRepo;
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
            $projectInput['project_name'] = Input::get('project_name');
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
             
            if(Input::get('family_id') > 0)
            {
                $projectInput['family_id'] = Input::get('family_id');
            }
            
            if(Input::get('blueprint_id') > 0)
            {
                $projectInput['blueprint_id'] = Input::get('blueprint_id');
            }
            
            //Assign returned value of a project id created to a variable.
            $projectID = $this->createProjectWith($projectInput);
            
            // Store values from the contact form
//            $projectValues = Input::only('project_name');
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
            
            $projectItems = $this->projectItemRepo->getItemsForProject($id);
            
            return View::make('project.show', array('project' => $project,
                'projectItems' => $projectItems));
            
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
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
