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
Route::get('/test',function(){
    $user = \App\User::findOrFail(1);
    $user->password = \Hash::make(123456);
    $user->save();

});
Route::get('/','HomeController@index')->name('home');
Route::get('/lapdu','Lapdu\LapduController@create')->name('lapdu.index');
Route::post('/lapdu','Lapdu\LapduController@store')->name('lapdu.store');

Route::get('/pengaduan-korupsi','omjaka\omjakaController@create')->name('omjaka.index');
Route::post('/pengaduan-korupsi','omjaka\omjakaController@store')->name('omjaka.store');

Route::get('/wbs','Wbs\WbsController@create')->name('wbs.index');
Route::post('/wbs','Wbs\WbsController@store')->name('wbs.store');

Route::get('/gratifikasi','gratifikasi\gratifikasiController@create')->name('gratifikasi.index');
Route::post('/gratifikasi','gratifikasi\gratifikasiController@store')->name('gratifikasi.store');

Route::get('/pengaduan-masyarakat','Pengaduan\PengaduanController@create')->name('pengaduan.create');
Route::post('/pengaduan-masyarakat','Pengaduan\PengaduanController@store')->name('pengaduan.store');
Route::get('/pengaduan-masyarakat/detail','Pengaduan\PengaduanController@detail')->name('pengaduan.detail');
Route::get('/{any}',function(){
    return view('index');
})->where('any', '.*');

Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');

