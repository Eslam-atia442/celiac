<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum ReservationStatusEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case active = 1;
    case completed = 2;
    case canceled = 3;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::canceled->value  => __('canceled'),
            self::active->value    => __('active'),
            self::completed->value => __('completed'),
        ];
    }
}
