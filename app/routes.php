<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

// NOTE TO FUTURE SELVES: FIX THIS TO BE MORE SECURE.


Route::get('/', function()
{
	return View::make('hello');
});
Route::resource('contact', 'ContactController');
Route::resource('donor', 'DonorController');
Route::resource('company', 'CompanyController');
Route::resource('project', 'ProjectController');
Route::resource('volunteer', 'VolunteerController');
Route::resource('family', 'FamilyController');
Route::get('volunteerhours/project/{project}','VolunteerHoursController@indexForProject');
Route::post('volunteerhours',array('as'=>'storehours','uses'=>'VolunteerHoursController@storehours'));
 Route::get('volunteerhours/project/{project}',array('as'=>'projHoursRoute', 'uses'=>'VolunteerHoursController@indexForProject'));

