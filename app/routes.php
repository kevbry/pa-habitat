<?php
require('authorizedroutes.php');
Route::resource('company', 'CompanyController', ['except' => ['destroy']]);
