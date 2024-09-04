<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum PatientAwarenessContentTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case adults = 1;
    case children = 2;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::adults->value   => __('adults'),
            self::children->value => __('children'),
        ];
    }
}
