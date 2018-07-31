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

Route::get('/robot/form', 'ParserController@test');
Route::post('/robot/postRegions', array('as' => 'robot.postRegions', 'uses' => 'ParserController@postRegions'));
Route::post('/robot/postCities', array('as' => 'robot.postCities', 'uses' => 'ParserController@postCities'));

Route::post('/robot/create_task', array('as' => 'robot.create_task', 'uses' => 'ParserController@create_task'));

Route::get('/robot/getRegions', array('as' => 'robot.getRegions', 'uses' => 'ParserController@getRegions'));
Route::get('/robot/getCities', array('as' => 'robot.getCities', 'uses' => 'ParserController@getCities'));

Route::get('/robot/tasks', array('as' => 'robot.tasks', 'uses' => 'ParserController@tasks'));

Route::get('/query/{city}/{prof}', 'ParserController@Query');
Route::get('/result/{place_id}/{photos_count}/{reviews_count}/{url}/{query}/{city}', 'ParserController@Pre_Insert_Result');
Route::resource('/cat', 'CatalogController');
Route::get('/cat/delete/{id}', 'CatalogController@delete');
Route::get('/cat_objects/{id}', 'CatalogController@catalog_objects');
Route::resource('object', 'ObjectController');
Route::get('/home', 'HomeController@index');


Route::get('/robot/', [ 'as' => 'robot', 'uses' => 'ParserController@tasks']);
Route::get('run_robot/{id}', array('as' => 'robot.run', 'uses' => 'ParserController@run_task'));
/*
 * Конфигурация
 */

Route::get('/config/cities', 'CatalogController@config_cities');
Route::get('/config/regions', 'CatalogController@config_regions');
Route::get('/config/country', 'CatalogController@config_country');

/*Дочерние сайты*/

Route::get('/daughters/', 'DaughterController@index');
Route::get('/daughters/edit/{id}', 'DaughterController@edit');
Route::get('/daughterrun', 'DaughterController@RecordData');

Route::get('/daughters/add', 'DaughterController@create_daughters');
Route::get('/daughter/acf/{id}', 'DaughterController@ch_acf');

Route::post('/daughters/add', 'DaughterController@save_daughters');
Route::post('/daughters/edit/{id}', 'DaughterController@save_daughters');
Route::get('/daughters/{id}/template/{template}', 'DaughterController@templates');
Route::post('/daughters/template/save', 'DaughterController@template_save');
Route::get('/daughters/control/{id}', 'DaughterController@control');
/*----------*/
Route::get('templates', 'DaughterController@templates');
