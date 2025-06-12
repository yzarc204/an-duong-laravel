<?php

namespace App\Enums;

use Henzeb\Enumhancer\Concerns\Enhancers;

enum GlucoseStatus: string
{
    use Enhancers;

    case LOW = 'low';
    case NORMAL = 'normal';
    case HIGH = 'high';

    public static function labels()
    {
        return [
            'LOW' => 'Thấp',
            'NORMAL' => 'Bình thường',
            'HIGH' => 'Cao',
        ];
    }

    public static function keysLabels()
    {
        return array_reduce(self::cases(), function ($carry, GlucoseStatus $item) {
            $carry[$item->value] = $item->label();
            return $carry;
        });
    }
}
