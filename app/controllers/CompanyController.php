<?php

use App\Repositories\CompanyRepository;

class CompanyController extends \BaseController {

    public $companyRepo;

    public function __construct(CompanyRepository $companyRepo) {
        $this->companyRepo = $companyRepo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        // Retrieve all companies from the database

        $sortby = Input::get('sortby');
        $order = Input::get('order');

        if ($sortby && $order) {

            $companyList = $this->companyRepo->orderBy($sortby, $order);
        } else {
            $companyList = $this->companyRepo->getAllCompanies();
        }

        // Return that to the list view
        return View::make('company.index', compact('sortby', 'order'))->with('companies', $companyList);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $company = $this->companyRepo->getCompany($id);

        return View::make('company.show')
                        ->withCompany($company);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
