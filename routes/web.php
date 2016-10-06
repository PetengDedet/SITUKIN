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


#######IKHWANMAFTUH
Route::get('admin/dashboard', ['as' => 'admin.dashboard', 'uses' => 'DashboardController@index']);
Route::get('userdatatables', ['as' => 'admin.dashboard.user.datatables', 'uses' => 'DashboardController@listData']);

#Jabatan
Route::get('admin/jabatan', 			['as' => 'admin.jabatan', 			'uses' => 'JabatanController@index']);
Route::get('admin/jabatan/{id}', 		['as' => 'admin.jabatan.show', 		'uses' => 'JabatanController@show']);
Route::get('admin/jabatan/create',	 	['as' => 'admin.jabatan.create',	'uses' => 'JabatanController@create']);
Route::post('admin/jabatan/create', 	['as' => 'admin.jabatan.post', 		'uses' => 'JabatanController@store']);
Route::get('admin/jabatan/edit/{id}',	['as' => 'admin.jabatan.edit.get',	'uses' => 'JabatanController@edit']);
Route::post('admin/jabatan/edit/{id}', 	['as' => 'admin.jabatan.edit.post', 'uses' => 'JabatanController@update']);

#Unit
Route::get('admin/unit', 				['as' => 'admin.unit.get', 		'uses' => 'UnitController@index']);
Route::post('admin/unit', 				['as' => 'admin.unit.post', 	'uses' => 'UnitController@store']);
Route::get('admin/unit/{id}', 			['as' => 'admin.unit.detail', 	'uses' => 'UnitController@show']);
Route::get('admin/unit/edit/{id}', 		['as' => 'admin.unit.edit', 	'uses' => 'UnitController@edit']);
Route::post('admin/unit/edit/{id}', 	['as' => 'admin.unit.edit', 	'uses' => 'UnitController@update']);

#Grade
Route::get('admin/grade', 				['as' => 'admin.grade.get', 	'uses' => 'GradeController@index']);
Route::post('admin/grade/update', 		['as' => 'admin.grade.post', 	'uses' => 'GradeController@update']);
Route::get('admin/grade/{id}', 			['as' => 'admin.grade.detail', 	'uses' => 'GradeController@show']);


######MASAGUNG
