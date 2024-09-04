<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum HealthLibraryTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case scientific_research = 1;
    case translated_book = 2;
    case guidance_manual = 3;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::scientific_research->value => __('scientific_research'),
            self::translated_book->value     => __('translated_book'),
            self::guidance_manual->value     => __('guidance_manual'),
        ];
    }
}
