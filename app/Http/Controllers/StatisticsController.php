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
        $gameColumnNames = array_filter($mazeGameResultsColumnNames, function ($columnName) {
            return (strpos($columnName, 'id') === false && strpos($columnName, 'registered') === false);
        });
        $puzzleGameResultsColumnNames = array_keys(PuzzleGamesResult::first()->getAttributes());
        $miniGameColumnNames = array_filter($puzzleGameResultsColumnNames, function ($columnName) {
            return (strpos($columnName, 'id') === false && strpos($columnName, 'registered') === false && strpos($columnName, 'name') === false && strpos($columnName, 'grade') === false);
        });

        $methods = [
            StatisticMethodsConstants::CORRELATION => "Correlation",
            StatisticMethodsConstants::T_TEST => "T Test",
        ];

        return view('pages.statistics.statistics',
            [
                'mazeGames' => $games,
                'mazeGameColumnNames' => $gameColumnNames,
                'miniGameColumnNames' => $miniGameColumnNames,
                'methods' => $methods
            ]
        );
    }
}
