<?php
 
class SessionController extends BaseController {
 
  /**
   * Show the form for creating a new Session
   */
  public function create()
  {
    return View::make('session.create');
  }
 
  public function store()
  {
    if (Auth::attempt(array('username' => Input::get('username'), 'password' => Input::get('password'))))
    {
        $user =  User::where('username', '=', Input::get('username'))->firstOrFail();
        Session::put('username', $user->username);
        Session::put('access_level', $user->access_level);

      return Redirect::intended('/');
    }
    return Redirect::route('session.create')
            ->withInput()
            ->with('login_errors', true);
  }
 
  public function destroy()
  {
    Auth::logout();
 
    return View::make('session.destroy');
  }
 
}