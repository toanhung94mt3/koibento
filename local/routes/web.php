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

Route::get('/', function () {
    return view('welcome');
});

//Admin Log-In 
Route::get('/admin', 'ProfileAdminController@logInPage');
Route::post('/admin', 'ProfileAdminController@logIn');
Route::get('/admin/logout', 'ProfileAdminController@logOut');



Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){

	//Main Pager Controller
	Route::get('index', 'ProductsAdminController@index');
	Route::get('load', 'ProductsAdminController@autoLoad');
	//Notification
	Route::get('read', 'ProductsAdminController@readNotification');
	
	//Product Controller
	Route::group(['prefix'=>'products'],function(){

		Route::get('/', 'ProductsAdminController@productsList');
		//Creator
		Route::get('creator', 'ProductsAdminController@creator');
		Route::post('creator', 'ProductsAdminController@create');
		Route::post('creator/get-id/{image}', 'ProductsAdminController@getImage');
		Route::post('creator/get-id-swap/{img}', 'ProductsAdminController@getImageEditor');
		//Editor
		Route::get('{product}/editor', 'ProductsAdminController@editor');
		Route::patch('{product}/editor', 'ProductsAdminController@edit');
		//Destroyer
		Route::delete('{product}', 'ProductsAdminController@delete');
		//Search Enginer
		Route::post('search', 'ProductsAdminController@search');

	});

	//Profile Controller
	Route::group(['prefix'=>'users'],function(){

		Route::get('/', 'ProfileAdminController@list');
		Route::post('create', 'ProfileAdminController@create');
		Route::patch('{user}/edit', 'ProfileAdminController@edit');
		Route::delete('{user}', 'ProfileAdminController@delete');

	});
	
	//Order Controller
	Route::group(['prefix'=>'orders'],function(){

		Route::get('active', 'OrderAdminController@order');
		Route::post('active/{order}', 'OrderAdminController@check');
		Route::delete('active/{order}', 'OrderAdminController@remove');
		Route::get('history', 'OrderAdminController@history');
		Route::delete('history', 'OrderAdminController@delete');

	});

	//Income Controller
	Route::group(['prefix'=>'income'],function(){

		Route::get('table', 'IncomeAdminController@table');
		Route::delete('table/{income}', 'IncomeAdminController@delete');

	});

	//Image Controller
	Route::group(['prefix'=>'image'],function(){

		Route::get('/', 'ImageController@imageStore');
		Route::patch('{image}', 'ImageController@imageSlide');
		Route::delete('{image}', 'ImageController@imageDelete');
		Route::get('upload', 'ImageController@imageUpload');
		Route::post('upload', 'ImageController@imageUploadPost');

	});

	//Export data
	Route::group(['prefix'=>'export'],function(){

		//Excel
		Route::get('/users', 'ExportController@exportUsers');
		Route::get('/transactions', 'ExportController@exportTransactions');
		//PDF
		Route::get('/pdf/{order}', 'ExportController@ExportOrders');

	});

});






//User Page
Route::get('/', 'ProjectController@index');
Route::get('/about-us', 'ProjectController@aboutUs');
Route::get('/category/{category}', 'ProjectController@category');
Route::get('/info', 'ProjectController@infoUser');
Route::post('/category/{category}', 'ProjectController@sort');

//Cart Controller
Route::group(['prefix'=>'cart'],function(){

	Route::get('/', 'CartController@cart');
	Route::patch('add-to-cart/{product}', 'CartController@addToCart');
	Route::patch('quantity/{id}', 'CartController@changeQuantity');
	Route::delete('quantity/{id}', 'CartController@deleteCart');
	Route::post('confirm', 'CartController@confirmCart');
	Route::post('add-to-list/{product}', 'CartController@addToList');
	Route::get('remove-to-list/{product}', 'CartController@removeToList');

});

//Form Controller
Route::group(['prefix'=>'form'],function(){

	//Register
	Route::get('register', 'FormController@formRegister');
	Route::post('register', 'FormController@register');
	//Change password
	Route::patch('change', 'FormController@changePassword');
	//Login
	Route::get('login', 'FormController@formLogin');
	Route::post('login', 'FormController@login');
	//Logout
	Route::get('logout', 'FormController@logOut');
	//Search enginer
	Route::post('searchSuggest', 'FormController@searchSuggest');

});