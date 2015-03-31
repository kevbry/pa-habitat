<?php
require('authorizedroutes.php');
Route::resource('volunteerInterest', 'VolunteerInterestController', ['except' => ['update', 'destroy']]);

//Volunteer Interest routes
Route::get('volunteer/{volunteer}/interest/edit',array('as'=>'editInterests','uses'=>'VolunteerInterestController@edit'));
Route::post('volunteer/{volunteer}/interest/store',array('as'=>'storeInterests','uses'=>'VolunteerInterestController@store'));
Route::post('volunteer/{volunteer}/interest/update',array('as'=>'updateInterests','uses'=>'VolunteerInterestController@update'));
Route::get('volunteer/{volunteer}/interest/create',array('as'=>'createInterests','uses'=>'VolunteerInterestController@create'));