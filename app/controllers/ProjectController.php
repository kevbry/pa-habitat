<?php
use App\Repositories\ProjectRepository;

class ProjectController extends \BaseController {
        public $projectRepo;
        
        public function __construct(ProjectRepository $projectRepo)
        {
            $this->projectRepo = $projectRepo;
        }
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            // Retrieve all contacts from the database
            $projectList = $this->projectRepo->getAllProjects();
            
            // Return that to the list view
            return View::make('project.index')->with('projects', $projectList);
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
            // Store values from the contact form
            $projectValues = Input::only('project_name');
            
            // Create a new contact object to store in the database
            $project = new Project($projectValues);
            
            // Store contact
            $this->projectRepo->saveProject($project);
            
            // Grab the id of the new contact
            $id = $project->id;

           
            //assign a redirect variable
            $redirectVariable = Redirect::action('ProjectController@show',array($id));
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
            $project = $this->projectRepo->getProject($id);
            
            return View::make('project.show')
                    ->withProject($project);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
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
