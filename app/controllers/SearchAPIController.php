<?php
use App\Repositories\ContactRepository;
use App\Repositories\VolunteerRepository;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of searchAPIController
 *
 * @author cst222
 */
class SearchAPIController extends \BaseController
{
    private $contactRepo;
    private $volunteerRepo;
    
    function __construct(ContactRepository $contactRepo, VolunteerRepository $volunteerRepo)
    {
        $this->contactRepo = $contactRepo;
        $this->volunteerRepo= $volunteerRepo;
    }
    
    public function searchContacts()
    {   
        return $this->contactRepo->getContactSearchInfo(Input::get('contacts'));
    }
    
      public function searchVolunteers()
    {   
        return $this->volunteerRepo->getVolunteerSearchInfo(Input::get('volunteers'));
    }
    
    public function show()
    {
    }
}
