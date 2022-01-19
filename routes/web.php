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

// Route::get('/', function () {
    // return view('welcome');
// });
	Route::get('/', 'UserController@index');
	Route::get('/registration', 'UserController@registration');
	Route::post('/performvalidation', 'UserController@performvalidation');
	Route::get('/login', 'UserController@login');
	Route::post('/dologin', 'UserController@doLogin')->name('dologin');
	Route::get('/logout', 'UserController@logout');
	Route::get('/updateprofile', 'UserController@editprofile');
	Route::post('/updatedetail', 'UserController@update');
	Route::get('/updatepassword', 'UserController@editpassword');
	Route::post('/updatepass', 'UserController@changepass');	
	
