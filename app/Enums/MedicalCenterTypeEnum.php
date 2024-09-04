<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum MedicalCenterTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case book = 1;
    case video = 2;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::book->value  => __('book'),
            self::video->value => __('video'),
        ];
    }

    public static function getTitle($value)
    {

        return match ($value) {
            self::book->value => __('book'),
            self::video->value => __('video'),
            default => $value
        };
    }
}
