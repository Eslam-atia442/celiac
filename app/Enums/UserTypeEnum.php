<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum UserTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case admin = 1;
    case user = 2;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::admin->value => __('admin'),
            self::user->value  => __('user')
        ];
    }
}
