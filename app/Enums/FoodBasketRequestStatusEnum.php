<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum FoodBasketRequestStatusEnum: int implements EnumInterface
{
    use ConstantsTrait;


    case pending = 1;
    case accepted = 2;
    case rejected = 3;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::pending->value  => __('pending'),
            self::accepted->value => __('accepted'),
            self::rejected->value => __('rejected'),
        ];
    }


}
