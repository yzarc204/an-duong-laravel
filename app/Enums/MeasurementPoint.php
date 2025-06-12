<?php

namespace App\Enums;

use Henzeb\Enumhancer\Concerns\Comparison;
use Henzeb\Enumhancer\Concerns\Enhancers;

enum MeasurementPoint: string
{
    use Enhancers;
    use Comparison;

    case BEFORE_MEAL = 'before_meal';
    case AFTER_MEAL = 'after_meal';
    case BEFORE_EXERCISE = 'before_exercise';
    case AFTER_EXERCISE = 'after_exercise';

    public static function labels()
    {
        return [
            'BEFORE_MEAL' => 'Trước bữa ăn',
            'AFTER_MEAL' => 'Sau bữa ăn',
            'BEFORE_EXERCISE' => 'Trước khi tập',
            'AFTER_EXERCISE' => 'Sau khi tập'
        ];
    }

    public static function keysLabels()
    {
        return array_reduce(self::cases(), function ($carry, MeasurementPoint $item) {
            $carry[$item->value] = $item->label();
            return $carry;
        });
    }
}
