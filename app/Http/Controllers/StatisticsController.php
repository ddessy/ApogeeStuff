<?php

namespace App\Http\Controllers;

use App\Http\Constants\StatisticMethodsConstants;
use App\Models\Game;
use App\Models\MazeGameResult;
use App\Models\PuzzleGamesResult;
use Illuminate\Routing\Controller as BaseController;

class StatisticsController extends BaseController
{
    public function statisticsPage()
    {
        $games = Game::all();
        $mazeGameResultsColumnNames = array_keys(MazeGameResult::first()->getAttributes());
        $mazeGameColumnNames = array_filter($mazeGameResultsColumnNames, function ($columnName) {
            return (strpos($columnName, 'id') === false && strpos($columnName, 'registered') === false);
        });
        $puzzleGameResultsColumnNames = array_keys(PuzzleGamesResult::first()->getAttributes());
        $miniGameColumnNames = array_filter($puzzleGameResultsColumnNames, function ($columnName) {
            return (strpos($columnName, 'id') === false && strpos($columnName, 'registered') === false && strpos($columnName, 'name') === false && strpos($columnName, 'grade') === false);
        });

        $methods = StatisticMethodsConstants::METHODS_ARRAY;

        return view('pages.statistics.statistics',
            [
                'mazeGames' => $games,
                'mazeGameColumnNames' => $mazeGameColumnNames,
                'miniGameColumnNames' => $miniGameColumnNames,
                'methods' => $methods
            ]
        );
    }
}
