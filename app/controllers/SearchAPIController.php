<?php
use App\Repositories\ContactRepository;
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
    
    function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
    }
    public function searchContacts()
    {   
        return $this->contactRepo->getContactSearchInfo(Input::get('contacts'));
    }
    
    public function show()
    {
    }
}
