<?php


namespace App\Services;

use MathPHP\Statistics\ANOVA;
use MathPHP\Statistics\Correlation;
use MathPHP\Statistics\Descriptive;
use MathPHP\Statistics\EffectSize;
use MathPHP\Statistics\Significance;


class StatisticMethods
{
    public static function standardDeviation($data1): float
    {
        return Descriptive::standardDeviation($data1);
    }

    public static function standardError($standardDeviationValue, $countSquared): float
    {
        return $standardDeviationValue / sqrt($countSquared);
    }

    public static function correlation($data1, $data2): float
    {
        return Correlation::sampleCorrelationCoefficient($data1, $data2);
    }

    public static function tTest($data1, $data2): string
    {
        $result = Significance::tTestTwoSample($data1, $data2);
        return 'P1: ' . round($result['p1'], 6) .
            ' <br>' .
            'P2: ' . round($result['p2'], 6) .
            ' <br>' .
            'T Score: ' . round($result['t'], 6) .
            ' <br>' .
            'DF: ' . round($result['df'], 6);
    }

    public static function anovaOneWay($data1, $data2, $data3): string
    {
        $result = ANOVA::oneWay($data1, $data2, $data3)['ANOVA']['treatment'];
        return 'F: ' . round($result['F'], 6) .
            ' <br> ' .
            'P: ' . round($result['P'], 6);
    }

    public static function effectSizeCohensD($data1, $data2): float
    {
        $data1M = array_sum($data1) / count($data1);
        $data2M = array_sum($data2) / count($data2);
        $data1SD = self::standardDeviation($data1);
        $data2SD = self::standardDeviation($data2);
        return EffectSize::cohensD($data1M, $data2M, $data1SD, $data2SD);
    }

    public static function testMethod()
    {
        return 1;
    }
}
