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

Route::get('/test', 'ParserController@test');
Route::get('/query/{city}/{prof}', 'ParserController@Query');
Route::get('/result/{place_id}/{photos_count}/{reviews_count}/{url}/{query}/{city}', 'ParserController@Pre_Insert_Result');
Route::resource('/cat', 'CatalogController');
Route::get('/cat/delete/{id}', 'CatalogController@delete');
Route::get('/cat_objects/{id}', 'CatalogController@catalog_objects');
Route::resource('object', 'ObjectController');
Route::get('/home', 'HomeController@index');
Route::get('/daughterrun', 'DautghterController@RecordData');
Route::get('/daughter/acf/{id}', 'DautghterController@ch_acf');