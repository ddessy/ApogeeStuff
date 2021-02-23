<?php

namespace App\Http\Controllers\Api;

use App\Http\StatisticMethodsConstants;
use App\Models\Game;
use App\Models\MazeGameResult;
use App\Models\PuzzleGamesResult;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatisticsApiController extends Controller
{
    public function calculateMazeGameResult(Request $request)
    {
        $mazeGameId = $request->params['selectedMazeGameId'];
        $firstColumn = MazeGameResult::select($request->params['mazeGameFirstColumn'])->where('maze_game_id', $mazeGameId)->pluck($request->params['mazeGameFirstColumn'])->all();
        $secondColumn = MazeGameResult::select($request->params['mazeGameSecondColumn'])->where('maze_game_id', $mazeGameId)->pluck($request->params['mazeGameSecondColumn'])->all();
        $firstColumnCount = count($firstColumn);
        $secondColumnCount = count($secondColumn);

        $averageFirstColumn = 0;
        if ($firstColumnCount) {
            $averageFirstColumn = array_sum($firstColumn) / $firstColumnCount;
        }

        $averageSecondColumn = 0;
        if ($secondColumnCount) {
            $averageSecondColumn = array_sum($secondColumn) / $secondColumnCount;
        }

        $standardDeviationFirstColumn = stats_standard_deviation($firstColumn, true);
        $standardDeviationSecondColumn = stats_standard_deviation($secondColumn, true);

        $standardErrorFirstColumn = $standardDeviationFirstColumn / sqrt($firstColumnCount);
        $standardErrorSecondColumn = $standardDeviationSecondColumn / sqrt($secondColumnCount);

        $pearsonCorrelation = stats_stat_correlation($firstColumn, $secondColumn);
        $tTest = stats_stat_paired_t($firstColumn, $secondColumn);

        $response = [
            'averageFirstColumn' => round($averageFirstColumn, 6),
            'averageSecondColumn' => round($averageSecondColumn, 6),
            'standardDeviationFirstColumn' => round($standardDeviationFirstColumn, 6),
            'standardDeviationSecondColumn' => round($standardDeviationSecondColumn, 6),
            'standardErrorFirstColumn' => round($standardErrorFirstColumn, 6),
            'standardErrorSecondColumn' => round($standardErrorSecondColumn, 6),
            'pearsonCorrelation' => round($pearsonCorrelation, 6),
            'tTest' => round($tTest, 6),
        ];

        return response()->json($response, 200);
    }

    public function calculateMiniGameResult(Request $request)
    {
        $miniGameName = $request->params['selectedMiniGameName'];
        $firstColumn = PuzzleGamesResult::select($request->params['miniGameFirstColumn'])->where('puzzle_game_name', $miniGameName)->pluck($request->params['miniGameFirstColumn'])->all();
        $secondColumn = PuzzleGamesResult::select($request->params['miniGameSecondColumn'])->where('puzzle_game_name', $miniGameName)->pluck($request->params['miniGameSecondColumn'])->all();
        $firstColumnCount = count($firstColumn);
        $secondColumnCount = count($secondColumn);

        $averageFirstColumn = 0;
        if ($firstColumnCount) {
            $averageFirstColumn = array_sum($firstColumn) / $firstColumnCount;
        }

        $averageSecondColumn = 0;
        if ($secondColumnCount) {
            $averageSecondColumn = array_sum($secondColumn) / $secondColumnCount;
        }

        $standardDeviationFirstColumn = stats_standard_deviation($firstColumn, true);
        $standardDeviationSecondColumn = stats_standard_deviation($secondColumn, true);

        $standardErrorFirstColumn = $standardDeviationFirstColumn / sqrt($firstColumnCount);
        $standardErrorSecondColumn = $standardDeviationSecondColumn / sqrt($secondColumnCount);

        $pearsonCorrelation = stats_stat_correlation($firstColumn, $secondColumn);
        $tTest = stats_stat_paired_t($firstColumn, $secondColumn);

        $response = [
            'averageFirstColumn' => round($averageFirstColumn, 6),
            'averageSecondColumn' => round($averageSecondColumn, 6),
            'standardDeviationFirstColumn' => round($standardDeviationFirstColumn, 6),
            'standardDeviationSecondColumn' => round($standardDeviationSecondColumn, 6),
            'standardErrorFirstColumn' => round($standardErrorFirstColumn, 6),
            'standardErrorSecondColumn' => round($standardErrorSecondColumn, 6),
            'pearsonCorrelation' => round($pearsonCorrelation, 6),
            'tTest' => round($tTest, 6),
        ];

        return response()->json($response, 200);
    }

    public function getGame($id)
    {
        return Game::find($id);
    }

//    public function createGame(Request $request)
//    {
//        return Game::create($request->all());
//    }
//
//    public function updateGame(Request $request, $id)
//    {
//        $article = Game::findOrFail($id);
//        $article->update($request->all());
//
//        return $article;
//    }
//
//    public function deleteGame(Request $request, $id)
//    {
//        $article = Game::findOrFail($id);
//        $article->delete();
//
//        return 204;
//    }
}
