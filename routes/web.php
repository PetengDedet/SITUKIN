<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
Route::get('userdatatables', ['as' => 'admin.dashboard.user.datatables', 'uses' => 'DashboardController@listData']);
