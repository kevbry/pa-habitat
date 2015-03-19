<?php

class UserController extends \BaseController
{
    public function __construct()
    {
        $this->beforeFilter('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Retrieve  Users from the database

//        $sortby = Input::get('sortby');
//        $order = Input::get('order');
//
//        if ($sortby && $order) {
//
//           $contactList = $this->contactRepo->orderBy($sortby, $order);
//        } else {
//            $contactList = $this->contactRepo->getAllContacts();
//        }

        $userList = User::all();
        
        // Return that to the list view
        return View::make('user.index')->with('users', $userList);        
        
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
        $userInfo = Input::only('password', 'contact_id', 'username');
        $confirmPassword = Input::get('confirm_password');
        
        $response = null;
        
        
        // Ensure only one user is added for a contact
        if((User::where('contact_id', '=', $userInfo['contact_id'])->first()) !== null)
        {
            // Redirect back with errors
            return Redirect::action('UserController@create')
                    ->withInput(Input::except(array('password', 'confirm_password')))
                    ->withErrors(['DuplicateUser', 'user already exists']);
        }
        else
        {
            
            if ($userInfo['password'] !== $confirmPassword)
            {
                // Redirect back with errors
                return Redirect::action('UserController@create')
                        ->withInput(Input::except(array('password', 'confirm_password')))
                        ->withErrors(['PasswordMismatch', 'Passwords do not match']);
            }
            else
            {
                // Hash the user's password for storage
                $userInfo['password'] = Hash::make($userInfo['password']);

                // Save user to database
                $userID = $this->storeUserWith($userInfo);
                
                if ($userID > 0)
                {
                    return Redirect::action('UserController@show', $userID);
                }
            }            
        }
        
        return $response;
        
    }
    
    /**
     * Helper method to save a user to the data base
     * @param array $userInfo - array of info to store in db
     * @return int - the id of the newly added user
     */
    public function storeUserWith($userInfo)
    {
        $newUser = new User($userInfo);
        $newUser->save();

        return $userInfo['contact_id'];
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */    
    public function show($id)
    {
        $showUser = User::find($id);
        
        return View::make('user.show')->with('user', $showUser);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */    
    public function edit($id)
    {
        $editUser = User::find($id);
        
        return View::make('user.edit')->with('user', $editUser);
        
    }
    
    
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */    
    public function update($id)
    {
        // Get the updated field(s)
        $userID = Input::only('contact_id');
        $newUserInfo['access_level'] = Input::get('access_level');
        $newPassword = Input::get('password');
        $affectedRows = 0;
        
        // Temp 
        if ($newPassword === Input::get('confirm_password'))
        {
            if (!empty($newUserInfo['password']))
            {
                $newUserInfo['password'] = Hash::make($newPassword);
            }

            // Update the user row with new values
            $affectedRows = User::where($userID, '=', $userID)->update($newUserInfo);            
        }
        else if ($newUserInfo['password'] !== Input::get('confirm_password'))
        {
            return Redirect::action('UserController@edit', $userID)
                ->withInput(Input::except(array('password', 'confirm_password')))
                ->withErrors(['PasswordMismatch', 'Passwords do not match']);
        }

        
        if ($affectedRows > 0)
        {
            return Redirect::action('UserController@show', $userID);
        }
        
        return Redirect::action('UserController@index');
    }    
    
}
