<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum GuidanceManualFileTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case general = 1;
    case gluten_sensitivity = 2;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::general->value            => __('general'),
            self::gluten_sensitivity->value => __('gluten_sensitivity'),
        ];
    }
}
