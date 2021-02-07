<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ResultsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [DashboardController::class, 'dashboardPage']);
Route::get('/view-results', [ResultsController::class, 'viewResultsPage']);
Route::get('/view-results/game-results', [ResultsController::class, 'gameResultsPage']);
Route::post('/view-results/getMiniGameResults', [ResultsController::class, 'getMiniGameResults']);
Route::get('/view-results/mini-game-results', [ResultsController::class, 'miniGameResultsPage']);
