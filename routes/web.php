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

Route::get('/', 'SurveyController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::middleware('auth')->get('/results/{survey}', 'SurveyController@resultsPage');
Route::get('/survey/{id}', 'SurveyController@show');
