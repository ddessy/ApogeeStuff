<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\MazeGameResult;
use App\Models\PuzzleGamesResult;
use Illuminate\Routing\Controller as BaseController;

class StatisticsController extends BaseController
{
    public function analyticsPage()
    {
        $games = Game::all();
        $mazeGameResultsColumnNames = array_keys(MazeGameResult::first()->getAttributes());
        $puzzleGameResultsColumnNames = array_keys(PuzzleGamesResult::first()->getAttributes());
        $methods = ["correlation" => "Correlation", "standard_deviation" => "Standard Deviation", "standard_error" => "Standard Error"];

        return view('pages.statistics.statistics', ['games' => $games, 'gameColumnNames' => $mazeGameResultsColumnNames, 'miniGameColumnNames' => $puzzleGameResultsColumnNames, 'methods' => $methods]);
    }
}
