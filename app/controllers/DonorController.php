<?php

use App\Repositories\DonorRepository;

class DonorController extends \BaseController {

    public $donorRepo;

    public function __construct(DonorRepository $donorRepo) {
        $this->donorRepo = $donorRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        // Retrieve all contacts from the database

        $sortby = Input::get('sortby');
        $order = Input::get('order');

        if ($sortby && $order) {

            $donorList = $this->donorRepo->orderBy($sortby, $order);
        } else {
            $donorList = $this->donorRepo->getAllDonors();
        }



        // Return that to the list view
        return View::make('donor.index', compact('sortby', 'order'))->with('donors', $donorList);
    }

}
