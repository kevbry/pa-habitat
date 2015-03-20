<?php
//Home Route
Route::get('/', array(
    'before' => 'auth',
    'uses'   => 'BaseController@index',
    'as'     => 'home.index'
));


//Project Contact routes
Route::get('project/{project}/contacts', array(
    'before' => 'auth|basicuser',
    'as' => 'projContactsView', 
    'uses' => 'ProjectContactController@index'
));
Route::get('project/{project}/contacts/create', array(
    'before' => 'auth|projectmanager',
    'as' => 'projContactsAdd', 
    'uses' => 'ProjectContactController@create'
));
Route::post('project/{project}/contacts/create', array(
    'before' => 'auth|projectmanager',
    'as' => 'projStoreContacts', 
    'uses' => 'ProjectContactController@store'
));


//Project Inspection routes
Route::get('project/{project}/inspections', array(
    'before' => 'auth|basicuser',
    'as' => 'projInspectionsView', 
    'uses' => 'ProjectInspectionController@index'
));
Route::get('project/{project}/inspections/create', array(
    'before' => 'auth|projectmanager',
    'as' => 'projInspectionsAdd', 
    'uses' => 'ProjectInspectionController@create'
));
Route::post('project/{project}/inspections/create', array(
    'before' => 'auth|projectmanager',
    'as' => 'storeInspections', 
    'uses' => 'ProjectInspectionController@store'
));
Route::get('project/{project}/inspections/edit',array(
    'before' => 'auth|administrator',
    'as' => 'editFormForInspections',
    'uses' => 'ProjectInspectionController@edit'
));
Route::post('project/{project}/inspections/edit',array(
    'before' => 'auth|administrator',
    'as' => 'updateFormInspections',
    'uses' => 'ProjectInspectionController@update'
));


//Project Item routes
Route::get('project/{project}/items', array(
    'before' => 'auth|basicuser',
    'as' => 'viewItems',
    'uses' => 'ProjectItemController@index'
));
Route::get('project/{project}/items/create', array(
    'before' => 'auth|projectmanager',
    'as' => 'projItemsAdd',
    'uses' => 'ProjectItemController@create'
));
Route::post('project/{project}/items/create', array(
    'before' => 'auth|projectmanager',
    'as' => 'storeItems',
    'uses' => 'ProjectItemController@store'
));
Route::get('project/{project}/items/edit', array(
    'before' => 'auth|administrator',
    'as' => 'editFormForItems',
    'uses' => 'ProjectItemController@edit'
));
Route::post('project/{project}/items/edit', array(
    'before' => 'auth|administrator',
    'as' => 'updateFormItems',
    'uses' => 'ProjectItemController@update'
));


//Report routes
Route::get('volunteerhours/report/{volunteer}', array(
    'before' => 'auth|contactmanager',
    'as' => 'volunteerReport', 
    'uses' => 'VolunteerHoursController@viewHoursReport'
));
Route::get('projecthours/report/{volunteer}', array(
    'before' => 'auth|projectmanager',
    'as' => 'projectReport', 
    'uses' => 'VolunteerHoursController@viewHoursReportForProject'
));


//Search routes
Route::get('search/searchContacts', 'SearchAPIController@searchContacts');
Route::get('search/searchVolunteers', 'SearchAPIController@searchVolunteers');
Route::get('search/searchProjects', 'SearchAPIController@searchProjects');
Route::get('search/searchCompanies', 'SearchAPIController@searchCompanies');
Route::get('search/searchFamilies', 'SearchAPIController@searchFamilies');


//Session routes
Route::get('login', array(
  'uses' => 'SessionController@create',
  'as' => 'session.create'
));
Route::post('login', array(
  'uses' => 'SessionController@store',
  'as' => 'session.store'
));
Route::get('logout', array(
  'uses' => 'SessionController@destroy',
  'as' => 'session.destroy'
));


// User routes
Route::get('user',array(
    'before' => 'auth|projectmanager',
    'uses' => 'UserController@index',
    'as' => 'user.index'
));
Route::get('user/create',array(
    'before' => 'auth|projectmanager',
    'uses' => 'UserController@create',
    'as' => 'user.create'
));
Route::post('user',array(
    'before' => 'auth|projectmanager',
    'uses' => 'UserController@store',
    'as' => 'user.store'
));
Route::get('user/{userid}',array(
    'before' => 'auth|projectmanager',
    'uses' => 'UserController@show',
    'as' => 'user.show'
));
Route::get('user/{userid}/edit',array(
    'before' => 'auth|administrator',
    'uses' => 'UserController@edit',
    'as' => 'user.edit'
));
Route::put('user/{userid}',array(
    'before' => 'auth|administrator',
    'uses' => 'UserController@update',
    'as' => 'user.update'
));


//Volunteer Hour Routes
Route::get('volunteerhours/project/{project}',array(
    'before' => 'auth|contactmanager',
    'uses' => 'VolunteerHoursController@indexForProject'
));
Route::post('volunteerhours',array(
    'uses'=>'VolunteerHoursController@storehours',
    'as'=>'storehours'
));
Route::get('volunteerhours/volunteer/{volunteer}',array(
    'as'=>'volHoursRoute', 
    'uses'=>'VolunteerHoursController@indexForContact'
));
Route::get('volunteerhours/project/{project}',array(
    'as'=>'projHoursRoute',
    'uses'=>'VolunteerHoursController@indexForProject'
));
Route::get('volunteerhours/add/project/{project}',array(
    'as'=>'projHoursAdd', 
    'uses'=>'VolunteerHoursController@createForProject'
));
Route::get('volunteerhours/add/volunteer/{volunteer}',array(
    'as'=>'volHoursAdd', 
    'uses'=>'VolunteerHoursController@createForContact'
));
Route::get('volunteerhours/volunteerEdit/{volunteer}',array(
    'as'=>'volHoursEditRoute', 
    'uses'=>'VolunteerHoursController@indexForEditContact'
));
Route::post('volunteerhours/volunteerEdit/',array(
    'as'=>'updatehours',
    'uses'=>'VolunteerHoursController@updatehours'
));
Route::get('volunteerhours/edit/project/{project}',array(
    'as'=>'projHoursEdit', 
    'uses'=>'VolunteerHoursController@indexForEditProject'
));
Route::post('volunteerhours/edit/project/',array(
    'as'=>'updateProjectHours',
    'uses'=>'VolunteerHoursController@updateProjectHours'
));