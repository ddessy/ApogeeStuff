<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GameApiController;
use App\Http\Controllers\Api\MiniGameApiController;
use App\Http\Controllers\Api\StatisticsApiController;

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

//GET
Route::get('games', [GameApiController::class, 'getGames']);
Route::get('miniGames/{gameId}', [MiniGameApiController::class, 'getMiniGames']);

//POST
Route::post('statistics/calculateGameResult', [StatisticsApiController::class, 'calculateGameResult']);
Route::post('statistics/calculateMiniGameResult', [StatisticsApiController::class, 'calculateMiniGameResult']);
