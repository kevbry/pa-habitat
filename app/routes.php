<?php
require_once('authorizedroutes.php');

Route::resource('contact', 'ContactController', ['except' => ['destroy']]);
Route::resource('donor', 'DonorController', ['only' => ['index']]);
Route::resource('company', 'CompanyController', ['only' => ['index', 'show', 'create','store']]);
Route::resource('project', 'ProjectController', ['except' => ['destroy']]);
Route::resource('volunteer', 'VolunteerController', ['only' => ['index']]);
Route::resource('family', 'FamilyController', ['except' => ['update', 'destroy']]);
