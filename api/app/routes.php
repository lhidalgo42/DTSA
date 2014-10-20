<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Raspberry Request
|--------------------------------------------------------------------------
|
*/

Route::get('update/{mac}/{type}/{data}','ValueController@create');
Route::get('control','ControlController@update');


/*
|--------------------------------------------------------------------------
| Sessions and Authentication
|--------------------------------------------------------------------------
|
*/

Route::get('/login','SessionController@create');
Route::post('/login', 'SessionController@store');
Route::group(array('before' => 'auth'), function(){

});
/*
|--------------------------------------------------------------------------
| User Validations
|--------------------------------------------------------------------------
|
*/
Route::group(array('before' => 'auth'), function(){
    Route::get('/', 'UsersController@index');
    Route::get('/dashboard', 'UsersController@index');
    Route::get('/profile', 'UsersController@profile');
    Route::get('control/{sensor}/{value}', 'ControlController@create');
    Route::get('logout', array('uses' => 'SessionController@destroy'));
});
/*
|--------------------------------------------------------------------------
| Ajax Request
|--------------------------------------------------------------------------
|
*/
Route::get('data/{Token}', 'ControlController@create');

