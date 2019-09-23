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
Route::get('survey', 'SurveyCntroler@index');
Route::get('survey/start', 'SurveyCntroler@two_h');
Route::get('survey/{id}', 'SurveyCntroler@show');
Route::post('survey', 'SurveyCntroler@store');
Route::put('survey/{id}', 'SurveyCntroler@update');
Route::delete('survey/{id}', 'SurveyCntroler@delete');

Route::get('device', 'DeviceController@index');
Route::get('device/{id}', 'DeviceController@show_survey');
Route::post('device', 'DeviceController@store');
Route::delete('device/{id}', 'DeviceController@delete');