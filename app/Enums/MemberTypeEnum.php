<?php

namespace App\Enums;

use App\Enums\Interfaces\EnumInterface;
use App\Traits\ConstantsTrait;

enum MemberTypeEnum: int implements EnumInterface
{
    use ConstantsTrait;

    case board_of_directors = 1;
    case members_of_the_general_assembly = 2;
    case members_of_the_organizational_structure = 3;
    case members_of_committee = 4;


    public function label(): string
    {
        return $this->getLabels()[$this->value];
    }

    public static function getLabels(): array
    {
        return [
            self::board_of_directors->value                      => __('board_of_directors'),
            self::members_of_the_general_assembly->value         => __('members_of_the_general_assembly'),
            self::members_of_the_organizational_structure->value => __('members_of_the_organizational_structure'),
            self::members_of_committee->value                    => __('members_of_committee'),
        ];
    }
}
