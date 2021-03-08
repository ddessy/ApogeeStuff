<?php


namespace App\Services;


class StatisticMethods
{
    public static function standardDeviation($firstColumn) {
        return stats_standard_deviation($firstColumn, true);
    }

    public static function standardError($standardDeviationValue, $countSquared) {
        return $standardDeviationValue / sqrt($countSquared);
    }

    public static function correlation($firstColumn, $secondColumn) {
        return stats_stat_correlation($firstColumn, $secondColumn);
    }

    public static function tTest($firstColumn, $secondColumn) {
        return stats_stat_paired_t($firstColumn, $secondColumn);
    }
}
