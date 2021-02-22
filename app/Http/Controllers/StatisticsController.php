<?php

namespace App\Http\Controllers;

use App\Http\StatisticMethodsConstants;
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
        $gameColumnNames = array_filter($mazeGameResultsColumnNames, function ($columnName) {
            return (strpos($columnName, 'id') === false && strpos($columnName, 'registered') === false);
        });
        $puzzleGameResultsColumnNames = array_keys(PuzzleGamesResult::first()->getAttributes());
        $miniGameColumnNames = array_filter($puzzleGameResultsColumnNames, function ($columnName) {
            return (strpos($columnName, 'id') === false && strpos($columnName, 'registered') === false && strpos($columnName, 'name') === false && strpos($columnName, 'grade') === false);
        });
        $methods = [
            StatisticMethodsConstants::CORRELATION => "Correlation",
            StatisticMethodsConstants::STANRDARD_DEVIATION => "Standard Deviation",
            StatisticMethodsConstants::STANDARD_ERROR => "Standard Error"
        ];

        return view('pages.statistics.statistics',
            [
                'games' => $games,
                'gameColumnNames' => $gameColumnNames,
                'miniGameColumnNames' => $miniGameColumnNames,
                'methods' => $methods
            ]
        );
    }
}
