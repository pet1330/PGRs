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

// PROTECTED
Route::group(array('before' => 'auth'), function()
{

	Route::get('/', 'UserController@home');

	Route::get('/profile', 'UserController@profile');

	Route::get('/settings', 'UserController@settings');

	// Students entity

	Route::resource('/students', 'StudentsController');
	Route::get('/students/{enrolment}/recalculateEndDate', 'StudentsController@recalculateEndDate');
	Route::post('/students/{enrolment}/autoGenerateGS3', 'StudentsController@autoGenerateGS3');
	Route::post('/students/{enrolment}/autoGenerateGS5s', 'StudentsController@autoGenerateGS5s');
	Route::post('/students/{enrolment}/autoGenerateGS5b', 'StudentsController@autoGenerateGS5b');
	Route::post('/students/{enrolment}/autoGenerateGS7', 'StudentsController@autoGenerateGS7');
	Route::post('/students/{enrolment}/autoGenerateGS8', 'StudentsController@autoGenerateGS8');
	Route::get('/students/supervisors/create/{enrolment}', 'SupervisorsController@createForStudent');
	Route::post('/students/supervisors/create', 'SupervisorsController@storeForStudent');
	Route::resource('/students.history', 'HistoryController', ['only' => ['create', 'store', 'edit', 'update', 'destroy']]);
	Route::resource('/students.events', 'EventsController');
	Route::resource('/students.absences', 'AbsencesController', ['only' => ['create', 'show', 'store', 'edit', 'update', 'destroy']]);

	Route::get('events', 'EventsController@upcomingIndex');
	
	Route::resource('/staff', 'StaffController');

	Route::get('/reports', function () {
		return view('admin.pages.reports.index');
	});

	Route::get('/import', function () {
		return view('admin.pages.import.index');
	});
	Route::post('/import/newStudents', 'StudentsController@importNew');

	Route::resource('/roles', 'RolesController');
	Route::resource('/permissions', 'PermissionsController');
	Route::resource('/global_settings', 'SettingsController', ['only' => ['index', 'update']]);

	Route::resource('/supervisors', 'SupervisorsController');
	Route::resource('/courses', 'CoursesController');
	Route::resource('/awards', 'AwardsController');
	Route::resource('/modes_of_study', 'ModesOfStudyController');
	Route::resource('/enrolment_status', 'EnrolmentStatusController');
	Route::resource('/ukba_status', 'UKBAStatusController');
	Route::resource('/funding_types', 'FundingTypesController');
	Route::resource('/absence_types', 'AbsenceTypesController');

	// Routes that require permissions...

	Entrust::routeNeedsPermission('students/create', 'can_create_student');
	Entrust::routeNeedsPermission('students/{enrolment}/edit', 'can_edit_student');
	Entrust::routeNeedsPermission('students/supervisors/create/*', 'can_create_supervision_record');
	Entrust::routeNeedsPermission('supervisors/{enrolment}/edit', 'can_edit_supervision_record');
	Entrust::routeNeedsPermission('staff/create', 'can_create_staff');
	Entrust::routeNeedsPermission('staff/{id}/edit', 'can_edit_staff');

	// Routes that require specific roles....

	Entrust::routeNeedsRole('reports*', 'admin');
	Entrust::routeNeedsRole('courses*', 'admin');
	Entrust::routeNeedsRole('awards*', 'admin');
	Entrust::routeNeedsRole('modes_of_study*', 'admin');
	Entrust::routeNeedsRole('enrolment_status*', 'admin');
	Entrust::routeNeedsRole('ukba_status*', 'admin');
	Entrust::routeNeedsRole('funding_types*', 'admin');
	Entrust::routeNeedsRole('absence_types*', 'admin');
	Entrust::routeNeedsRole('roles*', 'admin');
	Entrust::routeNeedsRole('permissions*', 'admin');
	Entrust::routeNeedsRole('global_settings*', 'admin');
});

// AUTH FILTER
Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::to('/login');
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