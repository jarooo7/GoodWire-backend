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

Route::post('login', 'APILoginController@login');
Route::get('logout', 'APILoginController@logout');
Route::post('me', 'APILoginController@me');
Route::middleware('jwt.auth')->get('users', function () {
    return auth('api')->user();
});

Route::get('survey', 'SurveyCntroler@index');
Route::get('surveybetweenh', 'SurveyCntroler@two_h');
Route::get('surveybetweenh/{data_time1}/{data_time2}', 'SurveyCntroler@show_betweenh');
Route::get('loc/{data_time1}/{data_time2}/{standLat}/{standLng}/{km}', 'SurveyCntroler@show_loc');
Route::get('survey/{id}', 'SurveyCntroler@show');
Route::post('surveyd', 'SurveyCntroler@stored');
Route::post('survey', 'SurveyCntroler@store');
Route::put('survey/{id}', 'SurveyCntroler@update');
Route::delete('survey/{id}', 'SurveyCntroler@delete');

Route::get('device', 'DeviceController@index');
Route::get('device/{key}', 'DeviceController@show_survey');
Route::post('device', 'DeviceController@store');
Route::put('device/{key}', 'DeviceController@update');
Route::delete('device/{key}', 'DeviceController@delete');

Route::get('key', 'ControllerBaseKey@index');
Route::put('key/{id}', 'ControllerBaseKey@update');
Route::post('key', 'ControllerBaseKey@store');
Route::delete('key/{id}', 'ControllerBaseKey@delete');