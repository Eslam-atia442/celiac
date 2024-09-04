<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum AssociationTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case board_of_directors = 1;
    case the_general_assembly = 2;
    case the_organizational_structure = 3;

    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::board_of_directors->value           => __('board_of_directors'),
            self::the_general_assembly->value         => __('members_of_the_general_assembly'),
            self::the_organizational_structure->value => __('members_of_the_organizational_structure'),
        ];
    }
}
