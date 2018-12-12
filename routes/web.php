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

Route::get('/', 'HomeController@index');

Route::prefix('/admin')->group(function(){
	Route::group(['middleware'=>['auth']], function(){
		Route::get('/','DashboardController@index')->name('home');
		
		Route::prefix('/menu')->group(function(){
			Route::get('/','MenuController@index')->name('admin.menu');
			Route::post('/simpan','MenuController@simpan')->name('admin.menu.simpan');
			Route::post('/sort','MenuController@sort')->name('admin.menu.sort');
			Route::post('/hapus','MenuController@hapus')->name('admin.menu.hapus');
		});
		

	});	
	Auth::routes();
});

