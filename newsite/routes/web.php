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
Route::get('/report',function(){
	return view('report');
})->name('report');
Route::get('/subscriptions',function(){
	return view('subscriptions');
})->name('subscriptions');
Route::get('/subscriptions','subscriptionsController@getData');
Route::post('/subscriptions','subscriptionsController@filterByClass');

// Route::get('search','reportsController@index')->name('index');

// Route::post('/report','reportsController@getData');
// filters
Route::post('/report','reportsController@filterdata');

Route::get('/report','reportsController@search');
Route::get('/report','reportsController@index');
Route::get('/report','reportsController@getData');



Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
Route::get('/home','HomeController@getamount');
Route::get('/home','HomeController@getsales');
Route::get('/home','HomeController@getSalesRange');
Route::get('/home','HomeController@index');
// Route::post('/report','subscritptionsController@filterByClass');
