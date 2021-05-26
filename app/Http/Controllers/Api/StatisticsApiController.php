<?php

namespace App\Http\Controllers\Api;

use App\Http\Constants\StatisticMethodsConstants;
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

        $propertiesResults = [];
        $mazeGameMethodResults = [];

        for ($i = 0; $i < count($selectedProperties); $i++) {
            $property = $selectedProperties[$i];
            $propertyDataFromDb = MazeGameResult::select($property)->where('maze_game_id', $mazeGameId)->pluck($property)->all();
            if (count($propertyDataFromDb) > 0) {
                $average = array_sum($propertyDataFromDb) / count($propertyDataFromDb);
                $standardDeviation = StatisticMethods::standardDeviation($propertyDataFromDb);
                $standardError = StatisticMethods::standardError($standardDeviation, count($propertyDataFromDb));

                $propertiesResults[$property] = [
                    'average' => round($average, 6),
                    'standardDeviation' => round($standardDeviation, 6),
                    'standardError' => round($standardError, 6),
                    'data' => $propertyDataFromDb,
                ];
            }
        }

        $combinations = $this->getAllCombinations($selectedProperties);
        switch ($selectedMazeGameMethod) {
            case StatisticMethodsConstants::CORRELATION:
                foreach ($combinations as $combination) {
                    if (count($combination) == 2) {
                        $data1 = $propertiesResults[$combination[0]]['data'];
                        $data2 = $propertiesResults[$combination[1]]['data'];
                        $mazeGameMethodResults[join(" / ", $combination)] = round(StatisticMethods::correlation($data1, $data2), 6);
                    }
                }
                break;
            case StatisticMethodsConstants::T_TEST:
                foreach ($combinations as $combination) {
                    if (count($combination) == 2) {
                        $data1 = $propertiesResults[$combination[0]]['data'];
                        $data2 = $propertiesResults[$combination[1]]['data'];
                        $mazeGameMethodResults[join(" / ", $combination)] = StatisticMethods::tTest($data1, $data2);
                    }
                }
                break;
            case StatisticMethodsConstants::ANOVA:
                foreach ($combinations as $combination) {
                    if (count($combination) == 3) {
                        $data1 = $propertiesResults[$combination[0]]['data'];
                        $data2 = $propertiesResults[$combination[1]]['data'];
                        $data3 = $propertiesResults[$combination[2]]['data'];
                        $mazeGameMethodResults[join(" / ", $combination)] = StatisticMethods::anovaOneWay($data1, $data2, $data3);
                    }
                }
                break;
            case StatisticMethodsConstants::EFFECT_SIZE:
                foreach ($combinations as $combination) {
                    if (count($combination) == 2) {
                        $data1 = $propertiesResults[$combination[0]]['data'];
                        $data2 = $propertiesResults[$combination[1]]['data'];
                        $mazeGameMethodResults[join(" / ", $combination)] = round(StatisticMethods::effectSizeCohensD($data1, $data2), 6);
                    }
                }
                break;
            case StatisticMethodsConstants::TEST_METHOD:
                foreach ($combinations as $combination) {
                    if (count($combination) == 2) {
                        $data1 = $propertiesResults[$combination[0]]['data'];
                        $data2 = $propertiesResults[$combination[1]]['data'];
                        $mazeGameMethodResults[join(" / ", $combination)] = round(StatisticMethods::testMethod(), 6);
                    }
                }
                break;
            default:
                return response()->json(null, 400);
        }

        $response = [
            'propertiesResults' => $propertiesResults,
            'mazeGameMethodResults' => $mazeGameMethodResults,
        ];

        return response()->json($response, 200);
    }

    private function getAllCombinations($array)
    {
        // initialize by adding the empty set
        $results = array(array());

        foreach ($array as $element)
            foreach ($results as $combination)
                array_push($results, array_merge(array($element), $combination));

        return $results;
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
