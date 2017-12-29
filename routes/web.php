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

Route::get('/', function () {
    return view('index');
});

// Registration
Route::get('/register', function () {
    return view('auth.register');
});

Route::post('/register', array('as' => 'register.post','uses' => 'Auth\RegisterController@store'));

// Admin panel
Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
