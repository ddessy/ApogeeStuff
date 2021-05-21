<?php


namespace App\Services;

use MathPHP\Statistics\ANOVA;
use MathPHP\Statistics\EffectSize;
use MathPHP\Statistics\Significance;


class StatisticMethods
{
    public static function standardDeviation($data1): float
    {
        return stats_standard_deviation($data1, true);
    }

    public static function standardError($standardDeviationValue, $countSquared): float
    {
        return $standardDeviationValue / sqrt($countSquared);
    }

    public static function correlation($data1, $data2): float
    {
        return stats_stat_correlation($data1, $data2);
    }

    public static function tTest($data1, $data2): float
    {
        return Significance::tTestTwoSample($data1, $data2)['p1'];
    }

    public static function anovaOneWay($data1, $data2, $data3): float
    {
        return ANOVA::oneWay($data1, $data2, $data3)['ANOVA']['treatment']['P'];
    }

    public static function effectSizeCohensD($data1, $data2): float
    {
        $data1M = array_sum($data1) / count($data1);
        $data2M = array_sum($data2) / count($data2);
        $data1SD = self::standardDeviation($data1);
        $data2SD = self::standardDeviation($data2);
        return EffectSize::cohensD($data1M, $data2M, $data1SD, $data2SD);
    }

    public static function testMethod() {
        return 1;
    }
}
