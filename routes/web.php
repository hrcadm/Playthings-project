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

Route::get('/', 'Auth\LoginController@showLoginForm');

/////////////////////////////////////////////////////////////////////////////////////////
//////////////////////   AUTH ROUTES ////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

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

	////////// CRUD OPERATIONS ///////////

	Route::resource('users', 'UserController');

	Route::resource('vendors', 'VendorController');

	Route::resource('factories', 'FactoryController');

	Route::resource('items-test-passed', 'ItemsTestPassedController');

	Route::resource('items', 'ItemController');

	Route::resource('labs', 'LabController');

	Route::resource('standards', 'StandardController');

});