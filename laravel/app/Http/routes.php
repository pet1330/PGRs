<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//only accessible by admin users
Route::group(['middleware' => 'admin'], function()
{
	Route::resource('/students', 'StudentsController');

	Route::post('/students/{enrolment}/recalculateEndDate', 'StudentsController@recalculateEndDate');


	Route::get('/students/supervisors/create/{enrolment}', 'SupervisorsController@createForStudent');
	Route::post('/students/supervisors/create', 'SupervisorsController@storeForStudent');

	//homepage for admin...
	Route::get('/dashboard', 'AdminController@dashboard');

});

//only accessible by admin and staff users
Route::group(['middleware' => 'staff'], function()
{
	Route::resource('/students.history', 'HistoryController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);

	Route::resource('/students.events', 'EventsController');

	Route::resource('/staff', 'StaffController');

	Route::resource('/supervisors', 'SupervisorsController');

	Route::resource('/courses', 'CoursesController');

	Route::resource('/awards', 'AwardsController');

	Route::resource('/modes_of_study', 'ModesOfStudyController');

	Route::resource('/enrolment_status', 'EnrolmentStatusController');

	Route::resource('/ukba_status', 'UKBAStatusController');

	Route::resource('/funding_types', 'FundingTypesController');

	Route::resource('/absence_types', 'AbsenceTypesController');
});

//only accessible by student users
Route::group(['middleware' => 'staff'], function()
{
	Route::get('/myprofile', function()
	{
		return View::make('student.pages.blank');
	});
});

// Authentication routes...
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');

Route::get('/logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

// // Password reset link request routes...
// Route::get('password/email', 'Auth\PasswordController@getEmail');
// Route::post('password/email', 'Auth\PasswordController@postEmail');

// // Password reset routes...
// Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
// Route::post('password/reset', 'Auth\PasswordController@postReset');