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


// Must be logged in
Route::group(['middleware' => 'auth'], function () {

    // Surveys
    Route::get('/surveys/create', 'SurveyController@createSurveyPage');
    Route::post('/surveys', 'SurveyController@store');

    Route::get('/home', 'HomeController@home');

    Route::get('/results/{survey}', 'SurveyController@resultsPage');

});

// Public Routes
Route::get('/', 'HomeController@index');

Route::get('/surveys', 'SurveyController@index');

Auth::routes();

Route::get('/surveys/{id}', 'SurveyController@show');

