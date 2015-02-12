<?php
use App\Repositories\ContactRepository;
use App\Repositories\VolunteerRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\FamilyRepository;
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
    private $projectRepo;
    private $companyRepo;
    private $familyRepo;
    
    function __construct(ContactRepository $contactRepo, VolunteerRepository $volunteerRepo,
                        ProjectRepository $projectRepo, CompanyRepository $companyRepo, FamilyRepository $familyRepo )
    {
        $this->contactRepo = $contactRepo;
        $this->volunteerRepo= $volunteerRepo;
        $this->projectRepo= $projectRepo;
        $this->companyRepo= $companyRepo;
        $this->familyRepo=$familyRepo;
    }
    
    public function searchContacts()
    {   
        return $this->contactRepo->getContactSearchInfo(Input::get('contacts'));
    }
    
      public function searchVolunteers()
    {   
        return $this->volunteerRepo->getVolunteerSearchInfo(Input::get('volunteers'));
    }
    
       public function searchProjects()
    {   
        return $this->projectRepo->getProjectSearchInfo(Input::get('projects'));
    }
    
     public function searchCompanies()
    {   
        return $this->companyRepo->getCompanySearchInfo(Input::get('companies'));
    }
    
         public function searchFamily()
    {   
        return $this->familyRepo->getFamilySearchInfo(Input::get('families'));
    }
    
    public function show()
    {
    }
}
