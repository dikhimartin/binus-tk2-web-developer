<?php
use Illuminate\Support\Facades\Input;

Route::group(array('prefix' => LaravelLocalization::setLocale() . '/'), function () {
	Route::get('/', 'Auth\LoginController@showLoginForm');
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm'); 
});

Auth::routes();

Route::group(array('prefix' => LaravelLocalization::setLocale() . '/admin', 'namespace' => 'Admin'), function () {
	/*
	 |--------------------------------------------------------------------------
	 | MODUL DASHBOARD
	 |--------------------------------------------------------------------------
	*/
	Route::get('/dashboard', 'HomeController@index')->name('home');
	Route::post('/dashboard/report/grade-courses', 'HomeController@get_grade_courses');
	Route::post('/dashboard/report/grade-students', 'HomeController@get_grade_students');


	/*
	 |--------------------------------------------------------------------------
	 | MODUL MASTER
	 |--------------------------------------------------------------------------
	*/
	// Students
	Route::get('students',
	[
		'as'=>'students.index',
		'uses'=>'StudentController@index',
	]);
	Route::get('/students/{id}','StudentController@get_data_byid');
	Route::post('/students/save','StudentController@save');
	Route::post('/students/update','StudentController@update');
	Route::post('/students/change_status_active/{id}','StudentController@change_status_active');
	Route::post('/students/change_status_inactive/{id}','StudentController@change_status_inactive');
	Route::post('/students/deleted_all/{id}','StudentController@delete_all');
	Route::post('/students/deleted','StudentController@delete');

	// grades
	Route::get('grades',
	[
		'as'=>'grades.index',
		'uses'=>'GradeController@index',
	]);
	Route::get('/grades/{id}','GradeController@get_data_byid');
	Route::post('/grades/save','GradeController@save');
	Route::post('/grades/update','GradeController@update');
	Route::post('/grades/deleted_all/{id}','GradeController@delete_all');
	Route::post('/grades/deleted','GradeController@delete');


	/*
	 |--------------------------------------------------------------------------
	 | MODUL SETTING
	 |--------------------------------------------------------------------------
	*/
	// Profile & Setting
	Route::get('/my_profile','SettingController@my_profile');
	Route::post('/check_username','SettingController@check_username');
	Route::post('/update_profile','SettingController@update_profile');
	Route::post('/UpdateInlineName',  'SettingController@UpdateInlineName');
	Route::post('/UpdateInlineEmail',  'SettingController@UpdateInlineEmail');
	Route::post('/UpdateInlineTelephone',  'SettingController@UpdateInlineTelephone');
	Route::post('/UpdateInlineAddress',  'SettingController@UpdateInlineAddress');

	// Users
	Route::get('users',
	[
		'as'=>'users.index',
		'uses'=>'UsersController@index',
	]);
	Route::get('/get_users_data','UsersController@get_users_data');
	Route::get('/get_users_data_byid','UsersController@get_users_data_byid');
	Route::post('save_users','UsersController@save_users');
	Route::post('update_users','UsersController@update_users');
	Route::post('deleted_users','UsersController@deleted_users');


	// Users Role
	Route::get('roles',
	[
		'as'=>'roles.index',
		'uses'=>'RoleController@index',
	]);
	Route::get('roles/create',[
		'as'=>'roles.create',
		'uses'=>'RoleController@create',
	]);
	Route::get('roles/get_roles_byid','RoleController@get_roles_byid');
	Route::post('roles/create',['as'=>'roles.store','uses'=>'RoleController@store']);
	Route::get('roles/{id}',['as'=>'roles.show','uses'=>'RoleController@show']);
	Route::get('roles/{id}/edit',['as'=>'roles.edit','uses'=>'RoleController@edit']);
	Route::post('/roles/change_status_active/{id}','RoleController@change_status_active');
	Route::post('/roles/change_status_inactive/{id}','RoleController@change_status_inactive');
	Route::patch('roles/{id}',['as'=>'roles.update','uses'=>'RoleController@update']);
	Route::post('/roles/deleted_all/{id}','RoleController@delete_all');
	Route::post('roles/delete','RoleController@delete');

});


