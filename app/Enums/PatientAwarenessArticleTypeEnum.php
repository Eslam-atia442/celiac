<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum PatientAwarenessArticleTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case text = 1;
    case link = 2;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::text->value => __('text'),
            self::link->value => __('link'),
        ];
    }
}
