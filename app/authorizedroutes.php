<?php
/*
 * ADD ROUTE MODELS IN ALPHABETIC ORDER. FOLLOW FORMATTING STYLE
 */

//Company Routes
Route::get('company',array(
    'before' => 'auth|basicuser',
    'uses' => 'CompanyController@index',
    'as' => 'company.index'
));
Route::get('company/create',array(
    'before' => 'auth|contactmanager',
    'uses' => 'CompanyController@create',
    'as' => 'company.create'
));
Route::post('company',array(
    'before' => 'auth|contactmanager',
    'uses' => 'CompanyController@store',
    'as' => 'company.store'
));
Route::get('company/{companyid}',array(
    'before' => 'auth|basicuser',
    'uses' => 'CompanyController@show',
    'as' => 'company.show'
));


//Contact Routes
Route::get('contact',array(
    'before' => 'auth|basicuser',
    'uses' => 'ContactController@index',
    'as' => 'contact.index'
));
Route::get('contact/create',array(
    'before' => 'auth|contactmanager',
    'uses' => 'ContactController@create',
    'as' => 'contact.create'
));
Route::post('contact',array(
    'before' => 'auth|contactmanager',
    'uses' => 'ContactController@store',
    'as' => 'contact.store'
));
Route::get('contact/{contactid}',array(
    'before' => 'auth|basicuser',
    'uses' => 'ContactController@show',
    'as' => 'contact.show'
));
Route::get('contact/{contactid}/edit',array(
    'before' => 'auth|contactmanager',
    'uses' => 'ContactController@edit',
    'as' => 'contact.edit'
));
Route::put('contact/{contactid}',array(
    'before' => 'auth|contactmanager',
    'uses' => 'ContactController@update',
    'as' => 'contact.update'
));


//Donor Routes
Route::get('donor',array(
    'before' => 'auth|basicuser',
    'as'=>'donor.index', 
    'uses'=>'DonorController@index'
));


//Family Routes
Route::get('family',array(
    'before' => 'auth|basicuser',
    'uses' => 'FamilyController@index',
    'as' => 'family.index'
));
Route::get('family/create',array(
    'before' => 'auth|contactmanager',
    'uses' => 'FamilyController@create',
    'as' => 'family.create'
));
Route::post('family',array(
    'before' => 'auth|contactmanager',
    'uses' => 'FamilyController@store',
    'as' => 'family.store'
));
Route::get('family/{familyid}',array(
    'before' => 'auth|basicuser',
    'uses' => 'FamilyController@show',
    'as' => 'family.show'
));
Route::get('family/{familyid}/edit',array(
    'before' => 'auth|contactmanager',
    'uses' => 'FamilyController@edit',
    'as' => 'family.edit'
));
Route::put('family/{familyid}',array(
    'before' => 'auth|contactmanager',
    'uses' => 'FamilyController@update',
    'as' => 'family.update'
));


//Home Routes
Route::get('/', array(
    'before' => 'auth',
    'uses'   => 'HomeController@index',
    'as'     => 'home.index'
));
Route::get('unauthorized', array(
   'uses'    => 'HomeController@unauthorized',
    'as'     => 'unauthorized'
));


//Project Routes
Route::get('project',array(
    'before' => 'auth|basicuser',
    'uses' => 'ProjectController@index',
    'as' => 'project.index'
));
Route::get('project/create',array(
    'before' => 'auth|projectmanager',
    'uses' => 'ProjectController@create',
    'as' => 'project.create'
));
Route::post('project',array(
    'before' => 'auth|projectmanager',
    'uses' => 'ProjectController@store',
    'as' => 'project.store'
));
Route::get('project/{projectid}',array(
    'before' => 'auth|basicuser',
    'uses' => 'ProjectController@show',
    'as' => 'project.show'
));
Route::get('project/{projectid}/edit',array(
    'before' => 'auth|projectmanager',
    'uses' => 'ProjectController@edit',
    'as' => 'project.edit'
));
Route::put('project/{projectid}',array(
    'before' => 'auth|projectmanager',
    'uses' => 'ProjectController@update',
    'as' => 'project.update'
));


//Project Contact Routes
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


//Project Inspection Routes
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
    'before' => 'auth|projectmanager',
    'as' => 'editFormForInspections',
    'uses' => 'ProjectInspectionController@edit'
));
Route::post('project/{project}/inspections/edit',array(
    'before' => 'auth|projectmanager',
    'as' => 'updateFormInspections',
    'uses' => 'ProjectInspectionController@update'
));


//Project Item Routes
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
    'before' => 'auth|projectmanager',
    'as' => 'editFormForItems',
    'uses' => 'ProjectItemController@edit'
));
Route::post('project/{project}/items/edit', array(
    'before' => 'auth|projectmanager',
    'as' => 'updateFormItems',
    'uses' => 'ProjectItemController@update'
));


//Report Routes
Route::get('volunteerhours/report/{volunteer}', array(
    'before' => 'auth|contactmanager',
    'as' => 'volunteerReport', 
    'uses' => 'VolunteerHoursController@viewHoursReport'
));
Route::get('projecthours/report/{project}', array(
    'before' => 'auth|projectmanager',
    'as' => 'projectReport', 
    'uses' => 'VolunteerHoursController@viewHoursReportForProject'
));


//Search Routes
Route::get('search/searchContacts', 'SearchAPIController@searchContacts');
Route::get('search/searchVolunteers', 'SearchAPIController@searchVolunteers');
Route::get('search/searchProjects', 'SearchAPIController@searchProjects');
Route::get('search/searchCompanies', 'SearchAPIController@searchCompanies');
Route::get('search/searchFamilies', 'SearchAPIController@searchFamilies');


//Session Routes
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


// User Routes
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


//Volunteer Routes
Route::get('volunteer',array(
    'before' => 'auth|basicuser',
    'as'=>'volunteer.index', 
    'uses'=>'VolunteerController@index'
));


//Volunteer Hour Routes
Route::get('volunteerhours/volunteer/{volunteer}',array(
    'before' => 'auth|basicuser',
    'as'=>'volHoursRoute', 
    'uses'=>'VolunteerHoursController@indexForContact'
));
Route::get('volunteerhours/project/{project}',array(
    'before' => 'auth|basicuser',
    'as'=>'projHoursRoute',
    'uses'=>'VolunteerHoursController@indexForProject'
));
Route::get('volunteerhours/add/project/{project}',array(
    'before' => 'auth|projectmanager',
    'as'=>'projHoursAdd', 
    'uses'=>'VolunteerHoursController@createForProject'
));
Route::get('volunteerhours/add/volunteer/{volunteer}',array(
    'before' => 'auth|contactmanager',
    'as'=>'volHoursAdd', 
    'uses'=>'VolunteerHoursController@createForContact'
));
Route::post('volunteerhours',array(
    'before' => 'auth|contactmanager',
    'uses'=>'VolunteerHoursController@storehours',
    'as'=>'storehours'
));
Route::get('volunteerhours/volunteerEdit/{volunteer}',array(
    'before' => 'auth|contactmanager',
    'as'=>'volHoursEditRoute', 
    'uses'=>'VolunteerHoursController@indexForEditContact'
));
Route::post('volunteerhours/volunteerEdit/',array(
    'before' => 'auth|contactmanager',
    'as'=>'updatehours',
    'uses'=>'VolunteerHoursController@updatehours'
));
//START HERE SARAH
Route::get('volunteerhours/edit/project/{project}',array(
    'before' => 'auth|projectmanager',
    'as'=>'projHoursEdit', 
    'uses'=>'VolunteerHoursController@indexForEditProject'
));
Route::post('volunteerhours/edit/project/',array(
    'before' => 'auth|projectmanager',
    'as'=>'updateProjectHours',
    'uses'=>'VolunteerHoursController@updateProjectHours'
));