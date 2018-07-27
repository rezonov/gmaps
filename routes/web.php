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
/*Дочерние сайты*/

Route::get('/daughters/', 'DaughterController@index');
Route::get('/daughters/edit/{id}', 'DaughterController@edit');
Route::get('/daughterrun', 'DaughterController@RecordData');
Route::get('/daughters/add', 'DaughterController@create_daughters');
Route::get('/daughter/acf/{id}', 'DaughterController@ch_acf');

Route::post('/daughters/add', 'DaughterController@save_daughters');
Route::post('/daughters/edit/{id}', 'DaughterController@save_daughters');
Route::get('/daughters/{id}/template/{template}', 'DaughterController@templates');
Route::get('/daughters/control/{id}', 'DaughterController@control');
/*----------*/
Route::get('templates', 'DaughterController@templates');
