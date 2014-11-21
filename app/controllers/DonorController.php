<?php
use App\Repositories\DonorRepository;

class DonorController extends \BaseController {
    
        public $repo;

        public function __construct(DonorRepository $repo)
        {
            $this->repo = $repo;
        }
    
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
            return View::make('donor.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
            $values = Input::only('business_name');
            $donor = new Donor($values);
            $this->repo->saveDonor($donor,$values);
            $id = $donor->id;
            return Redirect::action('DonorController@show',array($id));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            $donor = $this->repo->getDonor($id);
            return View::make('donor.show')->withDonor($donor);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

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
