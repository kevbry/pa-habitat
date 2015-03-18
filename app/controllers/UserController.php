<?php

class UserController extends \BaseController
{
    
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
            $response = Redirect::action('UserController@create')
                    ->withInput(Input::except(array('password', 'confirm_password')))
                    ->withErrors(['DuplicateUser', 'user already exists']);
        }
        else
        {
            
            if ($userInfo['password'] !== $confirmPassword)
            {
                // Redirect back with errors
                $response = Redirect::action('UserController@create')
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
                    $response = Redirect::action('UserController@show', $userID);
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
        
        return $newUser->contact_id;
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
        $newAccessLevel = Input::only('access_level');
        
        
        // Update the user row with new values
        $affectedRows = User::where($userID, '=', $userID)->update($newAccessLevel);
        
        
        if ($affectedRows > 0)
        {
            return Redirect::action('UserController@show', $userID);
        }
        
        return Redirect::action('UserController@index');
    }    
    
}
