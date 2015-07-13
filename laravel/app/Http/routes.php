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

// Route::get('foo', ['middleware' => 'staff', function(){
// 	return 'You can only see this if you\'re a staff member';
// }]);

Route::resource('/staff/students', 'StudentsController');

Route::post('/staff/students/{enrolment}/recalculateEndDate', 'StudentsController@recalculateEndDate');

Route::get('/staff/students/supervisors/create/{enrolment}', 'SupervisorsController@createForStudent');
Route::post('/staff/students/supervisors/create', 'SupervisorsController@storeForStudent');

Route::resource('/staff/students.history', 'HistoryController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);

Route::resource('/staff/students.events', 'EventsController');

Route::resource('/staff/staff', 'StaffController');

Route::resource('/staff/supervisors', 'SupervisorsController');

Route::resource('/staff/courses', 'CoursesController');

Route::resource('/staff/awards', 'AwardsController');

Route::resource('/staff/modes_of_study', 'ModesOfStudyController');

Route::resource('/staff/enrolment_status', 'EnrolmentStatusController');

Route::resource('/staff/ukba_status', 'UKBAStatusController');

Route::resource('/staff/funding_types', 'FundingTypesController');

Route::resource('/staff/absence_types', 'AbsenceTypesController');

Route::get('/student', function()
{
    return View::make('student.pages.blank');
});

Route::get('/student/gs_forms', function()
{
    return View::make('student.pages.gs_forms');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
// Route::get('auth/register', 'Auth\AuthController@getRegister');
// Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');