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

//Volunteer Hour Routes
Route::get('volunteerhours/project/{project}','VolunteerHoursController@indexForProject');
Route::post('volunteerhours',array('as'=>'storehours','uses'=>'VolunteerHoursController@storehours'));
Route::get('volunteerhours/volunteer/{volunteer}',array('as'=>'volHoursRoute', 'uses'=>'VolunteerHoursController@indexForContact'));
Route::get('volunteerhours/project/{project}',array('as'=>'projHoursRoute', 'uses'=>'VolunteerHoursController@indexForProject'));
Route::get('volunteerhours/add/project/{project}',array('as'=>'projHoursAdd', 'uses'=>'VolunteerHoursController@createForProject'));
Route::get('volunteerhours/add/volunteer/{volunteer}',array('as'=>'volHoursAdd', 'uses'=>'VolunteerHoursController@createForContact'));
Route::get('volunteerhours/volunteerEdit/{volunteer}',array('as'=>'volHoursEditRoute', 'uses'=>'VolunteerHoursController@indexForEditContact'));
Route::post('volunteerhours/volunteerEdit/',array('as'=>'updatehours','uses'=>'VolunteerHoursController@updatehours'));

//Project Inspection routes
Route::get('project/{project}/inspections', array('as'=>'projInspectionsView', 'uses'=>'ProjectInspectionController@index'));
Route::get('project/{project}/inspections/create', array('as'=>'projInspectionsAdd', 'uses'=>'ProjectInspectionController@create'));
Route::post('project/{project}/inspections/create', array('as'=>'storeInspections', 'uses'=>'ProjectInspectionController@store'));

//Project Item routes
Route::get('project/{project}/items',array('as'=>'viewItems','uses'=>'ProjectItemController@index'));
Route::get('project/{project}/items/create',array('as'=>'projItemsAdd','uses'=>'ProjectItemController@create'));
Route::post('project/{project}/items/create',array('as'=>'storeItems','uses'=>'ProjectItemController@store'));
Route::get('project/{project}/items/edit',array('as'=>'editFormForItems','uses'=>'ProjectItemController@edit'));
Route::post('project/{project}/items/edit',array('as'=>'updateFormItems','uses'=>'ProjectItemController@update'));

//Report routes
Route::get('volunteerhours/report/{volunteer}', array('as'=>'volunteerReport', 'uses'=>'VolunteerHoursController@viewHoursReport'));
Route::get('projecthours/report/{volunteer}', array('as'=>'projectReport', 'uses'=>'VolunteerHoursController@viewHoursReportForProject'));


//Search routes
Route::get('search/searchContacts', 'SearchAPIController@searchContacts');
Route::get('search/searchVolunteers', 'SearchAPIController@searchVolunteers');
Route::get('search/searchProjects', 'SearchAPIController@searchProjects');
Route::get('search/searchCompanies', 'SearchAPIController@searchCompanies');
Route::get('search/searchFamilies', 'SearchAPIController@searchFamilies');


