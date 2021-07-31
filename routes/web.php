<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResultsController;
use App\Http\Controllers\StatisticsController;
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

Route::get('/', [QuizController::class, 'listQuizzes'])->name('quiz.listQuizzes')->middleware('checkAuth');

// TODO: add middleware to all


Route::get('/quizzes', [QuizController::class, 'listQuizzes'])->name('quiz.listQuizzes')->middleware('checkAuth');

Route::get('/quiz/{quizId}', [QuizController::class, 'showQuiz'])->name('quiz.showQuiz')->middleware('checkAuth');

Route::post('/quiz', [QuizController::class, 'doQuiz'])->name('quiz.doQuiz')->middleware('checkAuth');

Route::get('/login', [HomeController::class, 'showLogin'])->name('home.showLogin');

Route::post('/login', [HomeController::class, 'doLogin'])->name('home.doLogin');

Route::post('/checkEmailPassword', [HomeController::class, 'checkEmailPassword'])->name('home.checkEmailPassword');

Route::get('/logout', [HomeController::class, 'doLogout'])->name('home.doLogout');

Route::get('/registration', [HomeController::class, 'showRegistration'])->name('home.showRegistration');

Route::post('/registration', [HomeController::class, 'doRegistration'])->name('home.doRegistration');

Route::get('/checkemail/{email}', [HomeController::class, 'checkEmail'])->name('home.checkEmail');

Route::get('/profile', [HomeController::class, 'showProfile'])->name('home.showProfile')->middleware('checkAuth');

Route::post('/profile', [HomeController::class, 'editProfile'])->name('home.editProfile')->middleware('checkAuth');

// Results and statistics

Route::get('/view-results', [ResultsController::class, 'viewResultsPage'])->name('results.viewResults')->middleware('checkAuth');

Route::get('/view-results/game-results', [ResultsController::class, 'gameResultsPage'])->name('results.gameResults')->middleware('checkAuth');

Route::post('/view-results/getMiniGameResults', [ResultsController::class, 'getMiniGameResults'])->name('results.getMiniGameResults')->middleware('checkAuth');
Route::get('/view-results/mini-game-results', [ResultsController::class, 'miniGameResultsPage'])->name('results.miniGameResults')->middleware('checkAuth');

Route::get('/statistics', [StatisticsController::class, 'statisticsPage'])->name('statistics.statistics')->middleware('checkAuth');
