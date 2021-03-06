<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/me','AuthJWT\AuthController@me');
Route::post('/register', 'AuthJWT\AuthController@register');
Route::post('/login', 'AuthJWT\AuthController@login');
Route::post('/logout', 'AuthJWT\AuthController@logout');
Route::post('/edit-profile','AuthJWT\AuthController@EditProfile');
Route::get('/survey','PertanyaanController@data_survey')->name('get.survey');
Route::get('/dashboard','DahsboardController@index');


Route::middleware(['auth:api'])->group(function () {
Route::get('/role-management','Role\RoleManagementController@index');
Route::post('/role-management','Role\RoleManagementController@store');
Route::get('/role-management/{id}/edit','Role\RoleManagementController@edit');
Route::get('/pengaduan','Pengaduan\PengaduanController@index');
Route::get('/e-lapdu','Lapdu\LapduController@index');
Route::get('/e-lapdu/{id}/edit','Lapdu\LapduController@edit');
Route::put('/e-lapdu/{id}','Lapdu\LapduController@update');
Route::get('/omjaka','omjaka\omjakaController@index');
Route::get('/omjaka/{id}/edit','omjaka\omjakaController@edit');
Route::put('/omjaka/{id}','omjaka\omjakaController@update');
Route::get('/wbs','Wbs\WbsController@index');
Route::get('/wbs/{id}/edit','Wbs\WbsController@edit');
Route::put('/wbs/{id}','Wbs\WbsController@update');
Route::get('/gratifikasi','gratifikasi\gratifikasiController@index');
Route::get('/gratifikasi/{id}/edit','gratifikasi\gratifikasiController@edit');
Route::get('/pengaduan/{id}/edit','Pengaduan\PengaduanController@edit');
Route::put('/pengaduan/{id}','Pengaduan\PengaduanController@update');
Route::resource('masterdata', 'Masterdata\MasterdataController');

Route::resource('menu', 'Menu\MenuController');
Route::resource('users', 'Users\UsersController');
Route::resource('kategori', 'Kategori\KategoriController');
});
