<?php

use App\Repositories\ProjectContactRepository;
use App\Repositories\ProjectRepository;
/**
 * Specifies a controller for the ProjectContact class and functionality.
 */
class ProjectContactController extends \BaseController {

    public $projectRepo;
    public $projectContactRepo;

    public function __construct(ProjectContactRepository $projectContactRepo, ProjectRepository $projectRepo) 
    {
        $this->projectRepo = $projectRepo;
        $this->projectContactRepo = $projectContactRepo;
    }
    /**
     * Displays a list of all project inspections.
     */
    public function index($projectId) 
    {
        $project = $this->projectRepo->getProject($projectId);
        $projectContacts = $this->projectContactRepo->getContactsForProject($projectId);

        return View::make('projectcontact.index', array('project' => $project, 'projectContacts' => $projectContacts));
    }
    
    /**
     * Displays a page that allows for the creation of project inspections.
     */
    public function create($projectId) 
    {
        $project = $this->projectRepo->getProject($projectId);
        return View::make('projectcontact.create', array('id' => $projectId, 
            'project' => $project));
    }
    
    /**
     * Stores project inspections in the database.
     */
    public function store() {
        $projectContact = array();
        for ($i = 0; $i < count(Input::get('type')); $i++) 
        {
            $projectContact['project_id'] = Input::get('project_id');
            $projectContact['contact_id'] = Input::get('contact_id')[$i];
            $projectContact['role'] = Input::get('role')[$i];
            $projectContact['notes'] = Input::get('notes')[$i];

            if (empty($projectContact)) {
                throw new Exception('No Project Contact info inserted.');
            }
            $this->storeContactWith($projectContact);
        }

        return Redirect::action('ProjectContactController@index', $projectContact['project_id']);

    }

    /*
     * Stores a specific contact with a specific project.
     */
    public function storeContactWith($projectContact) {

        $contact = new ProjectContact($projectContact);

        // Store contact
        $this->projectContactRepo->saveProjectContact($contact);

        return $contact->id;
    }   
}