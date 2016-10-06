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


//IKHWANMAFTUH
Route::get('admin/dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
Route::get('userdatatables', ['as' => 'admin.dashboard.user.datatables', 'uses' => 'DashboardController@listData']);
Route::get('admin/jabatan', ['as' => 'admin.jabatan', 'uses' => 'JabatanController@index']);
Route::get('admin/unit', ['as' => 'admin.unit', 'uses' => 'UnitController@index']);
Route::post('admin/unit', ['as' => 'admin.unit', 'uses' => 'UnitController@store']);



//MASAGUNG
