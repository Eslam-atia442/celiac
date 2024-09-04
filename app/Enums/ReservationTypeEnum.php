<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum ReservationTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case online = 1;
    case onsite = 2;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::online->value => __('online'),
            self::onsite->value => __('onsite'),
        ];
    }
}
