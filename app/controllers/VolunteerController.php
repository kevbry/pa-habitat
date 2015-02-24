<?php

use App\Repositories\VolunteerRepository;

class VolunteerController extends \BaseController {

    public $volunteerRepo;

    public function __construct(VolunteerRepository $volunteerRepo) {
        $this->volunteerRepo = $volunteerRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        // Retrieve all contacts from the database
        //  $volunteerList = $this->volunteerRepo->getAllVolunteers();

        $sortby = Input::get('sortby');
        $order = Input::get('order');

        if ($sortby && $order) {

            $volunteerList = $this->volunteerRepo->orderBy($sortby, $order);
        } else {
            $volunteerList = $this->volunteerRepo->getAllVolunteers();
        }


        
        // Return that to the list view
        return View::make('volunteer.index', compact('sortby','order'))->with('volunteers', $volunteerList);
    }

}
