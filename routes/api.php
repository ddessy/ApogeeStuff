<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameApiController;

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

Route::get('games', [GameApiController::class, 'getGames']);
Route::get('games/{id}', 'App\Http\Controllers\Api\GameApiController@getGame');
Route::post('games', 'App\Http\Controllers\Api\GameApiController@createGame');
Route::put('games/{id}', 'App\Http\Controllers\Api\GameApiController@updateGame');
Route::delete('games/{id}', 'App\Http\Controllers\Api\GameApiController@deleteGame');
