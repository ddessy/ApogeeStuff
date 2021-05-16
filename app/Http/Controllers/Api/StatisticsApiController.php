<?php

namespace App\Http\Controllers\Api;

use App\Http\Constants\StatisticMethodsConstants;
use App\Models\Game;
use App\Models\MazeGameResult;
use App\Models\PuzzleGamesResult;
use App\Services\StatisticMethods;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StatisticsApiController extends Controller
{
    public function calculateMazeGameResult(Request $request)
    {
        $mazeGameId = $request->params['selectedMazeGameId'];
        $selectedProperties = $request->params['selectedProperties'];
        $selectedMazeGameMethod = $request->params['selectedMazeGameMethod'];

        $results = [];

        for ($i = 0; $i < count($selectedProperties); $i++) {
            $property = $selectedProperties[$i];
            $propertyDataFromDb = MazeGameResult::select($property)->where('maze_game_id', $mazeGameId)->pluck($property)->all();
            if (count($propertyDataFromDb) > 0) {
                $average = round(array_sum($propertyDataFromDb) / count($propertyDataFromDb), 6);
                $standardDeviation = round(StatisticMethods::standardDeviation($propertyDataFromDb), 6);
                $standardError = round(StatisticMethods::standardError($standardDeviation, count($propertyDataFromDb)), 6);

                $results[$selectedProperties[$i]] = [
                    'average' => $average,
                    'standardDeviation' => $standardDeviation,
                    'standardError' => $standardError,
                ];
            }
        }

        $methodResult = 0;

//        switch ($selectedMazeGameMethod) {
//            case StatisticMethodsConstants::CORRELATION:
//                $methodResult = StatisticMethods::correlation($firstColumn, $secondColumn);
//                break;
//            case StatisticMethodsConstants::T_TEST:
//                $methodResult = StatisticMethods::tTest($firstColumn, $secondColumn);
//                break;
//        }

        $response = [
            'propertiesResults' => $results,
            'mazeGameMethodResult' => round($methodResult, 6),
        ];

        return response()->json($response, 200);
    }

    public function calculateMiniGameResult(Request $request)
    {
        $miniGameName = $request->params['selectedMiniGameName'];
        $firstColumnResult = PuzzleGamesResult::select($request->params['miniGameFirstColumn'])->where('puzzle_game_name', $miniGameName)->pluck($request->params['miniGameFirstColumn'])->all();
        $secondColumnResult = PuzzleGamesResult::select($request->params['miniGameSecondColumn'])->where('puzzle_game_name', $miniGameName)->pluck($request->params['miniGameSecondColumn'])->all();
        $selectedMiniGameMethod = $request->params['selectedMiniGameMethod'];
        $firstColumnCount = count($firstColumnResult);
        $secondColumnCount = count($secondColumnResult);

        $averageFirstColumnResult = 0;
        $averageSecondColumnResult = 0;
        $methodResult = 0;

        if ($firstColumnCount) {
            $averageFirstColumnResult = array_sum($firstColumnResult) / $firstColumnCount;
        }

        if ($secondColumnCount) {
            $averageSecondColumnResult = array_sum($secondColumnResult) / $secondColumnCount;
        }

        $standardDeviationFirstColumn = StatisticMethods::standardDeviation($firstColumnResult);
        $standardDeviationSecondColumn = StatisticMethods::standardDeviation($secondColumnResult);

        $standardErrorFirstColumn = StatisticMethods::standardError($standardDeviationFirstColumn, $firstColumnCount);
        $standardErrorSecondColumn = StatisticMethods::standardError($standardDeviationSecondColumn, $secondColumnCount);

        switch ($selectedMiniGameMethod) {
            case StatisticMethodsConstants::CORRELATION:
                $methodResult = StatisticMethods::correlation($firstColumnResult, $secondColumnResult);
                break;
            case StatisticMethodsConstants::T_TEST:
                $methodResult = StatisticMethods::tTest($firstColumnResult, $secondColumnResult);
                break;
        }

        $response = [
            'averageFirstColumn' => round($averageFirstColumnResult, 6),
            'averageSecondColumn' => round($averageSecondColumnResult, 6),
            'standardDeviationFirstColumn' => round($standardDeviationFirstColumn, 6),
            'standardDeviationSecondColumn' => round($standardDeviationSecondColumn, 6),
            'standardErrorFirstColumn' => round($standardErrorFirstColumn, 6),
            'standardErrorSecondColumn' => round($standardErrorSecondColumn, 6),
            'miniGameMethodResult' => round($methodResult, 6),
        ];

        return response()->json($response, 200);
    }
}
