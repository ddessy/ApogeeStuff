<?php


namespace App\Http\Constants;


class StatisticMethodsConstants
{
    const CORRELATION = 'correlation';
    const T_TEST = 't_test';
    const ANOVA = 'anova';
    const EFFECT_SIZE = 'effect_size';
    const TEST_METHOD = 'test_method';

    const METHODS_ARRAY = [
        self::CORRELATION => "Correlation",
        self::T_TEST => "T Test",
        self::ANOVA => "Anova",
        self::EFFECT_SIZE => "Effect size (Cohen`s d)",
        self::TEST_METHOD => "Test method",
    ];
}
