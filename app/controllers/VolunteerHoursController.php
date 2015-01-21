<?php
use App\Repositories\VolunteerHoursRepository;
use App\Repositories\VolunteerRepository;
use App\Repositories\ProjectRepository;

class VolunteerHoursController extends \BaseController {
        
    
    public $volunteerRepo;
    public $projectRepo;
    public $volunteerHrsRepo;

    public function __construct(VolunteerRepository $volunteerRepo, ProjectRepository $projectRepo, VolunteerHoursRepository $volunteerHrsRepo)
    {
        $this->volunteerRepo = $volunteerRepo;
        $this->projectRepo = $projectRepo;
        $this->volunteerHrsRepo = $volunteerHrsRepo;
    }
    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexForProject($projectId)
	{
            $volunteers = $this->volunteerRepo->getAllVolunteers();
            $project = $this->projectRepo->getProject($projectId);
            $volunteerHours = $this->volunteerHrsRepo->getHoursForProject($projectId);

            return View::make('volunteerhours.project',
                    array('id'=>$projectId, 'volunteers' => $volunteers,
                        'project'=>$project, 'volunteerhours'=>$volunteerHours));
	}

	public function indexForContact($contactId)
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function storehours()
	{
            // Store values from the contact form
//            $hoursInfo = Input::only('volunteer_id', 
//                                    'hours', 
//                                    'date_of_contribution',
//                                    'project_id');
//            // Check if the hours being created are paid
//            $hoursInfo['paid_hours'] = Input::has('paid_hours') ? 1 : 0;
            
            // Store the contact
            //$id = $this->storeHoursWith($hoursInfo);
            for($i = 0; $i < count(Input::get('volunteer_id')); $i++){
                $hoursInfo['volunteer_id']          = Input::get('volunteer_id')[$i];
                $hoursInfo['hours']                 = Input::get('hours')[$i];
                $hoursInfo['date_of_contribution']  = Input::get('date_of_contribution')[$i];
                $hoursInfo['project_id']            = Input::get('project_id')[$i];
                $hoursInfo['paid_hours']            = Input::get('paid_hours')[$i];
                $id = $this->storeHoursWith($hoursInfo);
            }
            
            return Redirect::action('VolunteerHoursController@indexForProject', $hoursInfo['project_id']);

	}
        
        public function storeHoursWith($hoursInfo)
        {
            $hours = new VolunteerHours($hoursInfo);
            
//            $hours = array('volunteer_id'=>14,'project_id'=>7,'date_of_contribution'=>'2014-01-16','hours'=>3,'paid_hours'=>0);
//            $volunteerHours = new VolunteerHours($hours);
            
            // Store contact
            $this->volunteerHrsRepo->saveVolunteerHours($hours);
            
            return $hours->id;
        }


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
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
