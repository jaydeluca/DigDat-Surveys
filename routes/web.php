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

// Public Routes
Route::get('/', 'HomeController@index');

Route::get('/surveys', 'SurveyController@index');
Route::get('/surveys/{id}', 'SurveyController@show');

Auth::routes();

// Must be logged in
Route::group(['middleware' => 'auth'], function () {

    // Surveys
    Route::get('/results/{survey}', 'SurveyController@resultsPage');

    Route::get('/home', 'HomeController@home');

});

