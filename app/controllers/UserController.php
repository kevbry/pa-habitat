<?php
use App\Repositories\ContactRepository;

class UserController extends \BaseController
{
    
    public $contactRepo;
    
    public function __construct(ContactRepository $contactRepo)
    {
        $this->contactRepo = $contactRepo;
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
        return View::make('user.create');
    }
    
    
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */    
    public function store()
    {
        // Get form input
        $userInfo = Input::only('password', 'contact_id');
        $confirmPassword = Input::get('confirm_password');
        
        // Get the contact's email address
        $userContact = $this->contactRepo->getContact($userInfo['contact_id']);
        $emailUsername = $userContact['email_address'];
        
        $userInfo['email_username'] = $emailUsername;
        
        if ($userInfo['password'] !== $confirmPassword)
        {
            // Change to something more professional before pushing
            return 'NO MATCH';
        }
        else
        {
            $userInfo['password'] = Hash::make($userInfo['password']);
            
            // Save user to database
            $newUser = new User($userInfo);
            $newUser->save();
        }
        

        return "ADDED";
        
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */    
    public function show($id)
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */    
    public function edit($id)
    {
        
        
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */    
    public function update($id)
    {
        
        
    }    
    
}
