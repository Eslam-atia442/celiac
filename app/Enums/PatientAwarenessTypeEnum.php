<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum PatientAwarenessTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case file = 1;
    case article = 2;
    case video = 3;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::file->value    => __('file'),
            self::article->value => __('article'),
            self::video->value   => __('video'),
        ];
    }
}
