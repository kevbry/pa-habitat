<?php

use App\Repositories\ProjectInspectionRepository;
use App\Repositories\ProjectRepository;

class ProjectInspectionController extends \BaseController {

    public $projectRepo;
    public $projectInspectionRepo;

    public function __construct(ProjectInspectionRepository $projectInspectionRepo, ProjectRepository $projectRepo) 
    {
        $this->projectRepo = $projectRepo;
        $this->projectInspectionRepo = $projectInspectionRepo;
    }

    public function index($projectId) 
    {
        $project = $this->projectRepo->getProject($projectId);
        $projectInspections = $this->projectInspectionRepo->getInspectionsForProject($projectId);

        return View::make('projectinspection.index', array('project' => $project, 'projectInspections' => $projectInspections));
    }
    
    public function create($projectId) 
    {
        $project = $this->projectRepo->getProject($projectId);
        return View::make('projectinspection.create', array('id' => $projectId, 
            'project' => $project));
    }

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

    public function storeInspectionWith($projectInspection) {

        $inspection = new ProjectInspection($projectInspection);

        // Store inspection
        $this->projectInspectionRepo->saveProjectInspection($inspection);

        return $inspection->id;
    }   
}