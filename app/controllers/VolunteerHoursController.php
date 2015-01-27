<?php

use App\Repositories\VolunteerHoursRepository;
use App\Repositories\VolunteerRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\FamilyRepository;

class VolunteerHoursController extends \BaseController {

    public $volunteerRepo;
    public $projectRepo;
    public $volunteerHrsRepo;
    public $familyRepo;

    public function __construct(VolunteerRepository $volunteerRepo, ProjectRepository $projectRepo, VolunteerHoursRepository $volunteerHrsRepo, FamilyRepository $familyRepo) {
        $this->volunteerRepo = $volunteerRepo;
        $this->projectRepo = $projectRepo;
        $this->volunteerHrsRepo = $volunteerHrsRepo;
        $this->familyRepo = $familyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function indexForProject($projectId) {
        $volunteers = $this->volunteerRepo->getAllVolunteers();
        $project = $this->projectRepo->getProject($projectId);
        $volunteerHours = $this->volunteerHrsRepo->getHoursForProject($projectId);
        $families = $this->familyRepo->getAllFamilies();

        return View::make('volunteerhours.project', array('id' => $projectId, 'volunteers' => $volunteers,
                    'project' => $project, 'volunteerhours' => $volunteerHours,
                    'families' => $families));
    }

    public function indexForContact($contactId) {
        $volunteer = $this->volunteerRepo->getVolunteer($contactId);
        $projects = $this->projectRepo->getAllProjects();
        $volunteerHours = $this->volunteerHrsRepo->getHoursForVolunteer($contactId);
       
        $families = $this->familyRepo->getAllFamilies();
       
        return View::make('volunteerhours.volunteer', array('id' => $contactId, 'volunteer' => $volunteer,
                    'projects' => $projects, 'volunteerhours' => $volunteerHours,
                    'families' => $families));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storehours() {
        $hoursInfo = array();
        for ($i = 0; $i < count(Input::get('volunteer_id')); $i++) {
            $hoursInfo['volunteer_id'] = Input::get('volunteer_id')[$i];
            $hoursInfo['hours'] = Input::get('hours')[$i];
            $hoursInfo['date_of_contribution'] = Input::get('date_of_contribution')[$i];
            $hoursInfo['project_id'] = Input::get('project_id')[$i];
            $hoursInfo['paid_hours'] = Input::get('paid_hours')[$i];
            if (Input::get('family_id')[$i] != 0) {
                $hoursInfo['family_id'] = Input::get('family_id')[$i];
            }

            if (empty($hoursInfo)) {
                throw new Exception('No Hours info inserted.');
            }
            $this->storeHoursWith($hoursInfo);
        }
$type=Input::get('pageType');
        if($type=='volunteer')
        {
             return Redirect::action('VolunteerHoursController@indexForContact', $hoursInfo['volunteer_id']);
        }
        else{
             return Redirect::action('VolunteerHoursController@indexForProject', $hoursInfo['project_id']);
        }
       
    }

    public function storeHoursWith($hoursInfo) {

        $hours = new VolunteerHours($hoursInfo);

        // Store contact
        $this->volunteerHrsRepo->saveVolunteerHours($hours);

        return $hours->id;
    }
    
    

}