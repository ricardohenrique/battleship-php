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

Route::get('boards', 'ControllerBoard@index');
Route::get('boards/{id}', 'ControllerBoard@show');
Route::post('boards', 'ControllerBoard@store');
Route::post('boards/{board_id}/ships/{ship_id}', 'ControllerBoard@putShip');
Route::get('ships', 'ControllerShip@index');
Route::get('ships/{id}', 'ControllerShip@show');

