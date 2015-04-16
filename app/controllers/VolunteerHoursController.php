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
        $families = $this->familyRepo->getAllFamiliesNonPaginated();

        return View::make('volunteerhours.project', array('id' => $projectId, 'volunteers' => $volunteers,
                    'project' => $project, 'volunteerhours' => $volunteerHours,
                    'families' => $families));
    }

    public function indexForContact($contactId)
    {
        $volunteer = $this->volunteerRepo->getVolunteer($contactId);
        $projects = $this->projectRepo->getAllProjects();
        $volunteerHours = $this->volunteerHrsRepo->getHoursForVolunteer($contactId);
       
        $families = $this->familyRepo->getAllFamiliesNonPaginated();
       
        return View::make('volunteerhours.volunteer', array('id' => $contactId, 'volunteer' => $volunteer,
                    'projects' => $projects, 'volunteerhours' => $volunteerHours,
                    'families' => $families));
    }
    
    public function createForProject($projectId) {
        $volunteers = $this->volunteerRepo->getAllVolunteersNonPaginated();
        $project = $this->projectRepo->getProject($projectId);
        $families = $this->familyRepo->getAllFamiliesNonPaginated();
        return View::make('volunteerhours.projectadd', array('id' => $projectId, 'volunteers' => $volunteers,
                    'project' => $project, 
                    'families' => $families));
    }
    
    public function createForContact($contactId) {
        $volunteer = $this->volunteerRepo->getVolunteer($contactId);
        $projects = $this->projectRepo->getAllProjectsNonPaginated();
        $families = $this->familyRepo->getAllFamiliesNonPaginated();
       
        return View::make('volunteerhours.volunteeradd', array('id' => $contactId, 'volunteer' => $volunteer,
                    'projects' => $projects, 
                    'families' => $families));
    }

    public function indexForEditContact($contactId) {
        //Created our own method to call the specific view.
        $volunteer = $this->volunteerRepo->getVolunteer($contactId);
        $projects = $this->projectRepo->getAllProjectsNonPaginated();
        if($contactId > -1)
        {
            $volunteerHours = $this->volunteerHrsRepo->getHoursForVolunteerNonPaginated($contactId);
        }
       
        $families = $this->familyRepo->getAllFamiliesNonPaginated();
       //Create view and pass in necessary parameters.
        return View::make('volunteerhours.volunteerEdit', array('id' => $contactId, 'volunteer' => $volunteer,
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
        $validationArray = array();
        $inputCount = count(Input::get('hours'));
        $type=Input::get('pageType');
                
        for ($i = 0; $i < $inputCount; $i++) {
            $hoursInfo['id'] = $i;
            if($type === 'volunteer')
            {
                $hoursInfo['volunteer_id'] = Input::get('volunteer_id'); 
                $hoursInfo['project_id'] = Input::get('project_id')[$i];
            }
            else
            {
                $hoursInfo['volunteer_id'] = Input::get('volunteer_id')[$i]; 
                $hoursInfo['project_id'] = Input::get('project_id')[$i];
                $hoursInfo['volunteer_id'] = $hoursInfo['volunteer_id'] != 0 ? $hoursInfo['volunteer_id'] : null;
            }

            $hoursInfo['hours'] = Input::get('hours')[$i];
            $hoursInfo['date_of_contribution'] = Input::get('date_of_contribution')[$i];
            $hoursInfo['paid_hours'] = Input::get('paid_hours')[$i];
            
            
            $hoursInfo['project_id'] = $hoursInfo['project_id'] != 0 ? $hoursInfo['project_id'] : null;
            
            if (Input::get('family_id')[$i] != 0) {
                $hoursInfo['family_id'] = Input::get('family_id')[$i];
            }
            else
            {
                $hoursInfo['family_id'] = null;
            }
            
            if (empty($hoursInfo)) {
                throw new Exception('No Hours info inserted.');
            }
            $validationArray[$i] = $hoursInfo;
        }
        
        $v = new App\Libraries\Validators\VolunteerHourValidator($validationArray, $inputCount);

        //If the validator passes with the input provided, based on the rules in the validator class.
        if($v->passes())
        {
            foreach($validationArray as $hoursInfo)
            {
                //Call our helper method on the row, to update it.
                $this->storeHoursWith($hoursInfo);
            }            
            //Store the contact and redirect to their show

            if($type==='volunteer')
            {
                return Redirect::action('VolunteerHoursController@indexForContact', $hoursInfo['volunteer_id']);
            }
            else
            {
                return Redirect::action('VolunteerHoursController@indexForProject', $hoursInfo['project_id']);
            }
        }
        {
            if($type==='volunteer')
            {
                return Redirect::action('VolunteerHoursController@createForContact', $hoursInfo['volunteer_id'])
                    ->withInput()->withErrors($v->getErrors());

            }
            else
            {
                return Redirect::action('VolunteerHoursController@createForProject', $hoursInfo['project_id'])
                    ->withInput()->withErrors($v->getErrors());
            }
        }
    }

    public function storeHoursWith($hoursInfo) {
        
        unset($hoursInfo['id']);
        $hours = new VolunteerHours($hoursInfo);

        // Store contact
        $this->volunteerHrsRepo->saveVolunteerHours($hours);

        return $hours->id;
    }
    //Method for getting the inputs from the volunteeredit view.
    public function updatehours()
    {
        //Create two arrays that will be used to delete/update
        $infoArray = array();
        $hoursInfo = array();
        //Fill an array with the inputs from the page, have to loop as they are
        //arrays
        $rowCount = count(Input::get('row_id'));
        
        $counter = 0;
        
        if ($rowCount > 0)
        {
            $arrayIndexes = array_keys(Input::get('hours'));
        }

        

        for ($i = 0; $i < $rowCount; $i++) {
            
            $rowIndex =  Input::get('row_id')[$counter];
            if (in_array($rowIndex, $arrayIndexes))
            {
                $hoursInfo['id'] = Input::get('row_id')[$counter];
                $hoursInfo['volunteer_id'] = Input::get('vol_id');
                $hoursInfo['hours'] = Input::get('hours')[$rowIndex];
                $hoursInfo['date_of_contribution'] = Input::get('date_of_contribution')[$rowIndex];
                $hoursInfo['project_id'] = Input::get('project_id')[$rowIndex];
                $hoursInfo['paid_hours'] = Input::get('paid_hours')[$rowIndex];
                if (Input::get('family_id')[$rowIndex] != 0) {
                    $hoursInfo['family_id'] = Input::get('family_id')[$rowIndex];
                }
                else
                {
                    $hoursInfo['family_id'] = null;
                }

                if (empty($hoursInfo)) {
                    throw new Exception('No Hours info inserted.');
                }
                //Add the specific hour row information into the $infoArray.
                $infoArray[$i] = $hoursInfo;
            }
            
            $counter++;
        }
        $v = new App\Libraries\Validators\VolunteerHourValidator($infoArray, $rowCount);
        
        if($v->passes())
        {
            foreach($infoArray as $hoursInfo)
            {
                //Call our helper method on the row, to update it.
                $this->updateHoursWith($hoursInfo);
            }
        }
        else
        {
            return Redirect::action('VolunteerHoursController@indexForEditContact', $hoursInfo['volunteer_id'] )
                    ->withInput()->withErrors($v->getErrors());
        }
        
        //Get a form field that gets the volunteers id that we are editing.
        //For safety sake made anothing variable that won't change on inputs.
        $id = Input::get('vol_id');
        
        //Get all the hours for the volunteer, will need this to delete.
        $hourArray = $this->volunteerHrsRepo->getHoursForVolunteerNonPaginated($id);

        //For every hour entry in the volunteers database.
        foreach($hourArray as $hourEntry)
        {
            //The hour hasn't been found yet.
            $bFound = false;
            //$infoArray is the inputs
            //$hourArray is the database
            //If the input array wasn't empty.
           
            if(!empty($infoArray))
            {
                foreach($infoArray as $formEntry)
                {
                    //if the input row got deleted from the page
                    if( strval($hourEntry['id']) == $formEntry['id'] )
                    {
                        //We found a row that should exist
                        $bFound = true;
                    }
                }
            }
            //If the row didn't exist on the page, but did in the database.
            if(!$bFound)
            {
                //Delete the row from the database.
                $affectedRows = VolunteerHours::where('id','=',$hourEntry['id'])->delete();
            }
        }
        //Redirect to the contacts hour page.
        return Redirect::action('VolunteerHoursController@indexForContact', $id);
    }
    //Helper method to update a row in the database
    /*
     * $hoursInfo = the row passed in to update.
     */
    public function updateHoursWith($hoursInfo)
    {
        $counter = 0;
        //An array of the database field names.
        $fieldNames = array(
            'id',
            'volunteer_id',
            'hours',
            'date_of_contribution',
            'project_id',
            'paid_hours',
            'family_id'
        );
        //An array of field->values to be populated to be updated.
        $fieldUpdateValues = array();
        //For every field in $hoursInfo.
        foreach($hoursInfo as $fieldValue)
        {
            //Don't update the first one as that's just an id that is needed as a key lower.
            if($counter != 0)
            {
                //Add the key ($fieldNames[$counter]) with the value $fieldValue
                //To an array of field->values
                $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
            }
            $counter++; 
        }
        //Update the row with the array of field->values
        $affectedRows = VolunteerHours::where('id','=',$hoursInfo['id'])->update($fieldUpdateValues);
    }
    /*
     * Function to generate an hours report for a volunteer
     */
    public function viewHoursReport($id)
    {
        $volunteer = $this->volunteerRepo->getVolunteer($id);
        $projects = $this->projectRepo->getAllProjects();
        $volunteerHours = $this->volunteerHrsRepo->getHoursForVolunteerSortedByProject($id);
        
        //Count the total hours for the volunteer.
        $totalHours = 0;
        if(!empty($volunteerHours))
        {
            foreach($volunteerHours as $hour)
            {
                $totalHours += $hour->hours;
            }
        }
       
        $families = $this->familyRepo->getAllFamiliesNonPaginated();
        //Make the volunteer hour report view.
        return View::make('report.volunteer', array('id' => $id, 'volunteer' => $volunteer,
                    'projects' => $projects, 'volunteerhours' => $volunteerHours,
                    'families' => $families, 'totalHours' => $totalHours));
    }
    /*
     * Generate a hours report for project
     */
    public function viewHoursReportForProject($id)
    {
        $project = $this->projectRepo->getProject($id);
        $volunteers = $this->volunteerRepo->getAllVolunteers();
        $volunteerHours = $this->volunteerHrsRepo->getHoursForProjectSortedByVolunteer($id);
        
        //Get the total hours for the project.
        $totalHours = 0;
        if(!empty($volunteerHours) && count($volunteerHours) != 0)
        {
            foreach($volunteerHours as $hour)
            {
                $totalHours += $hour->hours;
            }
        }
       
        $families = $this->familyRepo->getAllFamiliesNonPaginated();
        //Make the project hours view.
        return View::make('report.project', array('id' => $id, 'project' => $project,
                    'volunteers' => $volunteers, 'volunteerhours' => $volunteerHours,
                    'families' => $families, 'totalHours' => $totalHours));
    }
    /*
     * function that builds the edit project hours view.
     */
    public function indexForEditProject($projectId) {
        $volunteers = $this->volunteerRepo->getAllVolunteersNonPaginated();
        $project = $this->projectRepo->getProject($projectId);
        $volunteerHours = $this->volunteerHrsRepo->getHoursForProject($projectId);
        $projects = $this->projectRepo->getAllProjectsNonPaginated();
       
        $families = $this->familyRepo->getAllFamiliesNonPaginated();
       //Generate the edit project hours view.
        return View::make('volunteerhours.projectedit', array('id' => $projectId, 'volunteers' => $volunteers,
                    'project' => $project, 'projects' => $projects, 'volunteerhours' => $volunteerHours,
                    'families' => $families));
    }
    /*
     * Function that takes the inputs of the page, and passes them to our update helper method
     * Also deletes any rows that were not found on the page.
     */
    public function updateProjectHours()
    {
        //Two arrays that will hold hour information later.
        $infoArray = array();
        $hoursInfo = array();
        //The static projectID that doesn't change on the page.
        $projectId = Input::get('proj_id');
        //For every field on the page, populate the hoursInfo array
        //With the values form the page.
        
        $rowCount = count(Input::get('row_id'));
        
        if ($rowCount > 0)
        {
            $arrayIndexes = array_keys(Input::get('hours'));
        }

        $counter = 0;
        
        for ($i = 0; $i < $rowCount; $i++) {
            
            $rowIndex = Input::get('row_id')[$counter];

            if (in_array($rowIndex, $arrayIndexes))
            {
                $hoursInfo['id']= Input::get('row_id')[$counter];
                $hoursInfo['project_id'] = Input::get('project_id')[$rowIndex];
                $hoursInfo['volunteer_id'] = Input::get('volunteer_id')[array_search($rowIndex, $arrayIndexes)];
                $hoursInfo['hours'] = Input::get('hours')[$rowIndex];
                $hoursInfo['date_of_contribution'] = Input::get('date_of_contribution')[$rowIndex];
                $hoursInfo['paid_hours'] = Input::get('paid_hours')[$rowIndex];
                if (Input::get('family_id')[$rowIndex] != 0) {
                    $hoursInfo['family_id'] = Input::get('family_id')[$rowIndex];
                }
                else
                {
                    $hoursInfo['family_id'] = null;
                }

                if (empty($hoursInfo)) {
                    throw new Exception('No Hours info inserted.');
                }
                //Add the hoursInfo data to the infoArray
                $infoArray[$i] = $hoursInfo;
            }

            $counter++;
        }

        
        $v = new App\Libraries\Validators\VolunteerHourValidator($infoArray, count(Input::get('row_id')));
        
        if($v->passes())
        {
            foreach($infoArray as $hoursInfo)
            {
                //Calls our helper method to update the hour row
                $this->projectUpdateHoursWith($hoursInfo);
            }
        }
        else
        {
            return Redirect::action('VolunteerHoursController@indexForEditProject', $hoursInfo['project_id'] )
                ->withInput()->withErrors($v->getErrors());
        }
        //Get the hours for the project from the database.
        $hourArray = $this->volunteerHrsRepo->getHoursForProjectNonPaginated($projectId);
        //For every database row of hours
        foreach($hourArray as $hourEntry)
        {
            //Haven't found a row to keep.
            $bFound = false;
            //If the array isn't empty.
            if(!empty($infoArray))
            {
                //For every row in the form.
                foreach($infoArray as $formEntry)
                {
                    //If the row exists on the form and the database
                    if( strval($hourEntry['id']) == $formEntry['id'] )
                    {
                        //We found a row to keep.
                        $bFound = true;
                    }
                }
            }
            //If we didn't find a row to keep (Didn't exist on the form)
            if(!$bFound)
            {
                //Nuke that row from the database.
                $affectedRows = VolunteerHours::where('id','=',$hourEntry['id'])->delete();
            }
        }
        //Redirect back to the project page.
        return Redirect::action('VolunteerHoursController@indexForProject', $projectId);
    }
    //Helper method to update a single row in the database.
    public function projectUpdateHoursWith($hoursInfo)
    {
        $counter = 0;
        //Create an array with the key fields of the database.
        $fieldNames = array(
            'id',
            'project_id',
            'volunteer_id',
            'hours',
            'date_of_contribution',
            'paid_hours',
            'family_id'
        );
        //Create an empty array that will be used to update the row.
        $fieldUpdateValues = array();
        //For field that was passed in.
        foreach($hoursInfo as $fieldValue)
        {
            //The first one is just an id used below as a primary key. Not updating it.
            if($counter != 0)
            {
                //Add the key ($fieldNames[$counter]) and the value ($fieldValue)
                //To the array $fieldUpdateValues.
                $fieldUpdateValues = array_add($fieldUpdateValues, $fieldNames[$counter], $fieldValue);
            }
            $counter++; 
        }
        //Update the row that $fieldUpdateValues contains the info for.
        $affectedRows = VolunteerHours::where('id','=',$hoursInfo['id'])->update($fieldUpdateValues);
    }
}
