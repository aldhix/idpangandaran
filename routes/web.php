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

/*
================================
Domain : news.idpangandaran.com
================================
*/
Route::domain('news.idpnd.com')->group(function () {
	Route::get('/','NewsHomeController@index')->name('news.home');
	Route::get('/read/{url}/{id}','NewsHomeController@read')->name('news.read');
	Route::get('/cat/{url}','NewsHomeController@cat')->name('news.cat');
	Route::get('/search','NewsHomeController@search')->name('news.search');
});

/*
================================
Domain : guide.idpangandaran.com
================================
*/
Route::domain('guide.idpnd.com')->group(function () {
	Route::get('/', function(){return "Hello World Guide";});
});

/*
================================
Domain : idpangandaran.com
================================
*/
Route::domain('idpnd.com')->group(function () {

	Route::get('/', 'HomeController@index')->name('index');
	Route::get('/read/{url}/{id}','HomeController@read')->name('portal.read');
	Route::get('/cat/{url}','HomeController@cat')->name('portal.cat');
	Route::get('/search','HomeController@search')->name('portal.search');

/*============= Admin  ====================================================================== */
	Route::prefix('/admin')->group(function(){
		Route::group(['middleware'=>['auth']], function(){
			Route::get('/','DashboardController@index')->name('home');
			
			Route::prefix('/menu')->group(function(){
				Route::get('/','MenuController@index')->name('admin.menu');
				Route::post('/simpan','MenuController@simpan')->name('admin.menu.simpan');
				Route::post('/sort','MenuController@sort')->name('admin.menu.sort');
				Route::post('/edit','MenuController@edit')->name('admin.menu.edit');
				Route::post('/hapus','MenuController@hapus')->name('admin.menu.hapus');
				Route::get('/second/{id}','MenuController@second')->name('admin.menu.second');
			});

			Route::prefix('/categorie')->group(function(){
				Route::get('/{id}','CategorieController@index')->name('admin.categorie');
				Route::post('/simpan','CategorieController@simpan')->name('admin.categorie.simpan');
				Route::post('/update','CategorieController@update')->name('admin.categorie.update');
				Route::post('/delete','CategorieController@delete')->name('admin.categorie.delete');
				Route::post('/addto','CategorieController@addTo')->name('admin.categorie.addto');
				// Route::post('/simpan','CategorieController@simpan')->name('admin.categorie.simpan');
				// Route::post('/sort','CategorieController@sort')->name('admin.categorie.sort');
				// Route::post('/hapus','CategorieController@hapus')->name('admin.categorie.hapus');
			});
			
			Route::prefix('/post')->group(function(){		
				Route::get('/test','PostController@test')->name('admin.test');
				Route::post('/save','PostController@save')->name('admin.post.save');
				Route::get('/data','PostController@data')->name('admin.post.data');
				Route::post('/delete','PostController@delete')->name('admin.post.delete');
				Route::get('/{iddomain}/add','PostController@add')->name('admin.post.add');
				Route::get('/{iddomain}/edit/{id}','PostController@edit')->name('admin.post.edit');
				Route::get('/{id}','PostController@index')->name('admin.post');
			});

			Route::prefix('/image')->group(function(){
				Route::get('/browser',function(){
					return view('pages.image.browser');
				})->name('admin.image.browser');
				Route::post('/upload','PhotoController@upload')->name('image.upload');
				Route::get('/data','PhotoController@data')->name('image.data');
			});

			Route::prefix('/domain')->group(function(){
				Route::get('/','DomainController@index')->name('admin.domain');
				Route::post('/simpan','DomainController@simpan')->name('admin.domain.simpan');
				Route::post('/edit','DomainController@edit')->name('admin.domain.edit');
				Route::post('/hapus','DomainController@hapus')->name('admin.domain.hapus');
			});

		});

		Auth::routes();
	
	});

});

