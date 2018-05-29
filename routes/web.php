<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////   PUBLIC ROUTES //////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

Route::get('/', function () {
    return view('welcome');
});

// Export routes for Item Test Records
Route::get('export-item-test-report', 'ExportItemTestReportController@exportItemTestReportView')->name('export-item-test-report');
Route::post('export-item-test-report', 'ExportItemTestReportController@exportItemTestReport')->name('post-export-item-test');

// Export routes for Certificate of Conformity
Route::get('export-coc', 'ExportCocController@exportItemTestReportView')->name('export-coc');
Route::post('export-coc', 'ExportCocController@exportItemTestReport')->name('post-export-coc');

/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////   AUTH ROUTES ////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');

/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////   APPLICATION ROUTES /////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function() {

	//////// AUTHED USER ROUTES //////////

	// authed index route
	Route::get('index', 'HomeController@index')->name('home');

	// Registration Routes...
	Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('register', 'Auth\RegisterController@register');

	// updating index by year
	Route::post('update-item-test-record', 'ItemsTestRecordController@updateIndex')->name('update-item-test-record');
	Route::post('get-item-test', 'ItemsTestRecordController@getItemTest')->name('get-item-test');

	Route::get('items-test-records/{id}/clone', 'ItemsTestRecordController@clone')->name('items-test-records.clone');
	Route::get('archive', 'ItemsTestRecordController@archive')->name('archive');


	////////// CRUD OPERATIONS ///////////
	Route::resources([
		'users' => 'UserController',
		'vendors' => 'VendorController',
		'factories' => 'FactoryController',
		'items' => 'ItemController',
		'labs' => 'LabController',
		'standards' => 'StandardController',
		'items-test-records' => 'ItemsTestRecordController'
	]);

});