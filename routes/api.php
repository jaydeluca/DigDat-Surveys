<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'auth' => 'api',
    'namespace' => 'API',
], function () {
    Route::post('survey/submit', 'SurveyAPIController@submit');
    Route::post('survey/create', 'SurveyAPIController@store');
    Route::get('survey/{id}', 'SurveyAPIController@show');
    Route::get('answers/{id}', 'AnswersAPIController@show');
});