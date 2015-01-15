<?php
use App\Repositories\VolunteerRepository;

class VolunteerHoursController extends \BaseController {
        
    
    public $volunteerRepo;

    public function __construct(VolunteerRepository $volunteerRepo)
    {
        $this->volunteerRepo = $volunteerRepo;
    }
    
    /**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function indexForProject($projectId)
	{
            $volunteers = $this->volunteerRepo->getAllVolunteers();
            foreach ($volunteers as $volunteer)
            {
                $volunteers['id'] = $
            } 
            
            return View::make('volunteerhours.project',array('id'=>$projectId, 'volunteers' => $volunteers));
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
	public function store()
	{
		//
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
