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

Route::resource('boards', 'ControllerBoard');
Route::post('boards/{board_id}/ships/{ships_id}', 'ControllerBoard@putShip');
Route::resource('ships', 'ControllerShip');
Route::resource('games', 'ControllerGame');
Route::post('games/{game_id}/shots', 'ControllerShot@shot');


