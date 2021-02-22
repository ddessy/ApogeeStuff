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
    public function calculateGameResult(Request $request)
    {
        $gameId = $request->params['selectedGameId'];
        $firstColumn = MazeGameResult::select($request->params['gameFirstColumn'])->where('maze_game_id', $gameId)->pluck($request->params['gameFirstColumn'])->all();
        $secondColumn = MazeGameResult::select($request->params['gameSecondColumn'])->where('maze_game_id', $gameId)->pluck($request->params['gameSecondColumn'])->all();
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

        $standardDeviationFirstColumn = stats_standard_deviation($firstColumn);
        $standardDeviationSecondColumn = stats_standard_deviation($secondColumn);

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
        $statisticMethod = $request->params['miniGameStatisticMethod'];
        $result = 0;

        switch ($statisticMethod) {
            case StatisticMethodsConstants::CORRELATION:
                $result = stats_stat_correlation($firstColumn, $secondColumn);
                break;
            case StatisticMethodsConstants::STANRDARD_DEVIATION:
                $result = 2;
                break;
            case StatisticMethodsConstants::STANDARD_ERROR:
                $result = 3;
                break;
        }

        return response()->json($result, 200);
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
