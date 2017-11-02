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
    Route::get('/surveys/create', 'SurveyController@createSurveyPage')->name('create-survey');
    Route::post('/surveys', 'SurveyController@store');
    Route::get('/home', 'HomeController@home');

});

// Public Routes
Route::get('/', 'HomeController@index');
Auth::routes();

// Public Survey Pages
Route::get('/surveys', 'SurveyController@index')->name('all-public-surveys');
Route::get('/surveys/{user_slug}', 'SurveyController@index')->name('user-surveys');
Route::get('/surveys/{user_slug}/{survey}', 'SurveyController@show');
Route::get('/surveys/{user_slug}/{survey}/results', 'SurveyController@resultsPage');
