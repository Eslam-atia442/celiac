<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum UserGenderEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case male = 1;
    case female = 2;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::male->value   => __('male'),
            self::female->value => __('female')
        ];
    }
}
