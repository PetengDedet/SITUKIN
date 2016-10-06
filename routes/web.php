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
Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
Route::get('userdatatables', ['as' => 'admin.dashboard.user.datatables', 'uses' => 'DashboardController@listData']);
Route::get('jabatan', ['as' => 'admin.jabatan', 'uses' => 'JabatanController@index']);
Route::get('unit', ['as' => 'admin.unit', 'uses' => 'UnitController@index']);
Route::post('unit', ['as' => 'admin.unit', 'uses' => 'UnitController@store']);



//MASAGUNG
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@login']);
Route::post('login', ['as' => 'loginPost', 'uses' => 'AuthController@loginPost']);
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
Route::post('simpan-pegawai', ['as' => 'simpanpegawai', 'uses' => 'UserController@simpanpegawai']);