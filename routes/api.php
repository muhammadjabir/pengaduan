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


Route::middleware(['auth:api'])->group(function () {
Route::get('/role-management','Role\RoleManagementController@index');
Route::post('/role-management','Role\RoleManagementController@store');
Route::get('/role-management/{id}/edit','Role\RoleManagementController@edit');
Route::get('/pengaduan','Pengaduan\PengaduanController@index');
Route::get('/e-lapdu','Lapdu\LapduController@index');
Route::get('/e-lapdu/{id}/edit','Lapdu\LapduController@edit');
Route::put('/e-lapdu/{id}','Lapdu\LapduController@update');
Route::get('/pengaduan/{id}/edit','Pengaduan\PengaduanController@edit');
Route::put('/pengaduan/{id}','Pengaduan\PengaduanController@update');
Route::resource('masterdata', 'Masterdata\MasterdataController');
Route::resource('menu', 'Menu\MenuController');
Route::resource('users', 'Users\UsersController');
Route::resource('kategori', 'Kategori\KategoriController');
});
