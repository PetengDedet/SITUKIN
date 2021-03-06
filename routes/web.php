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

Route::get('/', 						['as' => 'login', 					'uses' => 'AuthController@login']);


//IKHWANMAFTUH
Route::get('dashboard', 				['as' => 'dashboard', 				'uses' => 'DashboardController@index']);
Route::get('userdatatables', 			['as' => 'dashboard.user.datatables', 'uses' => 'DashboardController@listData']);
Route::get('jabatan', 					['as' => 'jabatan', 				'uses' => 'JabatanController@index']);
Route::get('unit', 						['as' => 'uni.get', 				'uses' => 'UnitController@index']);
Route::post('unit', 					['as' => 'unit.post', 				'uses' => 'UnitController@store']);

#Jabatan
Route::get('jabatan', 					['as' => 'admin.jabatan', 			'uses' => 'JabatanController@index']);
Route::get('jabatan/create',	 		['as' => 'admin.jabatan.create',	'uses' => 'JabatanController@create']);
Route::get('jabatan/{id}', 				['as' => 'admin.jabatan.show', 		'uses' => 'JabatanController@show']);
Route::post('jabatan/create', 			['as' => 'admin.jabatan.post', 		'uses' => 'JabatanController@store']);
Route::get('jabatan/edit/{id}',			['as' => 'admin.jabatan.edit.get',	'uses' => 'JabatanController@edit']);
Route::post('jabatan/edit/{id}', 		['as' => 'admin.jabatan.edit.post', 'uses' => 'JabatanController@update']);
Route::get('jabatan/{id}', 				['as' => 'admin.jabatan.show', 		'uses' => 'JabatanController@show']);

#Unit
Route::get('unit', 						['as' => 'admin.unit.get', 			'uses' => 'UnitController@index']);
Route::post('unit', 					['as' => 'admin.unit.post', 		'uses' => 'UnitController@store']);
Route::get('unit/{id}', 				['as' => 'admin.unit.detail', 		'uses' => 'UnitController@show']);
Route::get('unit/edit/{id}', 			['as' => 'admin.unit.edit', 		'uses' => 'UnitController@edit']);
Route::post('unit/edit/{id}', 			['as' => 'admin.unit.edit', 		'uses' => 'UnitController@update']);

#Grade
Route::get('grade', 					['as' => 'admin.grade.get', 		'uses' => 'GradeController@index']);
Route::post('grade/update', 			['as' => 'admin.grade.post', 		'uses' => 'GradeController@update']);
Route::get('grade/{id}', 				['as' => 'admin.grade.detail', 		'uses' => 'GradeController@show']);

#Manajemen User
Route::get('manajemen-user', 			['as' => 'manajemen-user', 			'uses' => 'ManajemenUserController@index']);
Route::get('getselected/{id}', 			['as' => 'getselected', 			'uses' => 'ManajemenUserController@getSelected']);
Route::post('manajemen/simpan',			['as' => 'manajemen.user',			'uses' => 'ManajemenUserController@simpan']);
Route::post('manajemen/hapus',			['as' => 'manajemen.hapus',			'uses' => 'ManajemenUserController@hapus']);

#SETTING
Route::get('setting', 					['as' => 'setting', 				'uses' => 'SettingController@index']);
Route::post('setting', 					['as' => 'setting.post', 			'uses' => 'SettingController@savePassword']);

#REPORT
Route::get('report1', ['uses' => 'JabatanController@tesPdf']);
Route::get('export/{unit}/{bulan}/{tahun}', ['uses' => 'ReportController@export']); //sudah

#Export
Route::get('export', ['uses' => 'ReportController@select']);
Route::post('export', ['uses' => 'ReportController@exportDatas']);
Route::get('export/per-golongan-jabatan', ['uses' => 'ReportController@perGolonganJabatan']);
Route::get('export/realisasi', ['uses' => 'ReportController@realisasi']);
Route::get('export/invoice', ['uses' => 'ReportController@invoice']);
Route::get('export/protakel', ['uses' => 'ReportController@protakel']); //sudah
Route::get('export/sdm', ['uses' => 'ReportController@sdm']); //sudah
Route::get('export/pembayaran', ['uses' => 'ReportController@pembayaran']);
Route::get('export-data/{unit_id}/{eselon_satu}', ['uses' => 'ReportController@exportdata']);



//MASAGUNG
#UserController
Route::get('pegawai', 					['as' => 'pegawai', 				'uses' => 'UserController@listpegawai']);
Route::post('pegawai/import-data', 					['as' => 'pegawai.importdata', 				'uses' => 'UserController@pegawaiimportdata']);
Route::post('pegawai/simpan-pegawai', 			['as' => 'simpanpegawai', 			'uses' => 'UserController@simpanpegawai']);
Route::post('pegawai/edit-pegawai', 			['as' => 'editpegawai', 			'uses' => 'UserController@editpegawai']);
Route::get('delete-pegawai/{id}', 		['as' => 'deletepegawai', 			'uses' => 'UserController@deletepegawai']);
Route::post('userjson', 				['as' => 'userjson', 				'uses' => 'UserController@userjson']);
Route::get('pegawai/create', 			['as' => 'pegawaicreate', 			'uses' => 'UserController@pegawaicreate']);
Route::get('pegawai/{id}', 				['as' => 'detailpegawai', 			'uses' => 'UserController@detailpegawai']);
Route::post('pegawaijson', 				['as' => 'pegawaijson', 			'uses' => 'UserController@pegawaijson']);

#AuthController
Route::get('login', 					['as' => 'login', 					'uses' => 'AuthController@login']);
Route::post('login', 					['as' => 'loginPost', 				'uses' => 'AuthController@loginPost']);
Route::get('logout', 					['as' => 'logout', 					'uses' => 'AuthController@logout']);

#JabatanController
Route::post('jabatanjson', 				['as' => 'jabatanjson', 			'uses' => 'JabatanController@jabatanjson']);

#RekapController
Route::get('rekap-data', 				['as' => 'rekapdata', 				'uses' => 'RekapController@rekapdata']);
Route::get('update', 					['as' => 'rekapdataupdate', 				'uses' => 'RekapController@update']);
Route::post('tambah-potongan-absen',			['as' => 'tambahpotonganabsen', 				'uses' => 'RekapController@tambahpotonganabsen']);
Route::post('datapotonganabsensi',			['as' => 'datapotonganabsensi', 				'uses' => 'RekapController@datapotonganabsensi']);
Route::post('simpan-rekap-data',			['as' => 'simpanrekapdata', 				'uses' => 'RekapController@simpanrekapdata']);

#HukumanController
Route::get('hukuman-disiplin', 			['as' => 'hukumandisiplin', 		'uses' => 'HukumanController@hukumandisiplin']);
Route::get('hukuman-disiplin/tambah', 	['as' => 'hukumandisiplintambah', 	'uses' => 'HukumanController@hukumandisiplintambah']);
Route::post('hukuman-pegawai/simpan', 	['as' => 'hukumandisiplinsimpan', 	'uses' => 'HukumanController@hukumandisiplinsimpan']);
Route::get('delete-hukuman/{id}', 		['as' => 'deletehukuman', 			'uses' => 'HukumanController@deletehukuman']);
