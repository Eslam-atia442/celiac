<?php

namespace Database\Seeders;

use App\Enums\PositionTypeEnum;
use Illuminate\Database\Seeder;

class PositionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \DB::table('positions')->delete();
//        $data = [
//            // مجلس الادارة
//            [
//                'name' => '{"ar":"رئيس مجلس الإدارة","en":"رئيس مجلس الإدارة"}',
//                'type'=> PositionTypeEnum::board_of_directors->value,
//            ],
//            [
//                'name' => '{"ar":" نائب رئيس مجلس الإدارة","en":" نائب رئيس مجلس الإدارة"}',
//                'type'=> PositionTypeEnum::board_of_directors->value,
//            ],
//            [
//                'name' => '{"ar":"عضو مجلس الإدارة","en":" عضو مجلس الإدارة"}',
//                'type'=> PositionTypeEnum::board_of_directors->value,
//            ],
//
//            //جمعية عمومية
//            [
//                'name' => '{"ar":"عضو مؤسس، رئيس مجلس الإدارة","en":"عضو مؤسس، رئيس مجلس الإدارة"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ],
//            [
//                'name' => '{"ar":"عضو مؤسس، نائب رئيس مجلس الإدارة","en":"عضو مؤسس، نائب رئيس مجلس الإدارة"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ],
//            [
//                'name' => '{"ar":"عضو مؤسس، عضو مجلس الإدارة","en":"عضو مؤسس، عضو مجلس الإدارة"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ],
//            [
//                'name' => '{"ar":"عضو عامل، عضو مجلس الإدارة","en":"عضو عامل، عضو مجلس الإدارة"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ],
//            [
//                'name' => '{"ar":"عضو مؤسس","en":"عضو مؤسس"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ],
//            [
//                'name' => '{"ar":"العضوية الذهبية","en":"العضوية الذهبية"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ],
//            [
//                'name' => '{"ar":"عضو فخري","en":"عضو فخري"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ],
//            [
//                'name' => '{"ar":"عضو منتسب","en":"عضو منتسب"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ],
//            [
//                'name' => '{"ar":"عضو عامل","en":"عضو عامل"}',
//                'type'=> PositionTypeEnum::the_general_assembly->value,
//            ]
//
//        ];
        \DB::table('positions')->insert(array (
            0 =>
                array (
                    'id' => 1,
                    'name' => '{"ar":"رئيس مجلس الادارة","en":"رئيس مجلس الادارة"}',
                    'is_active' => 1,
                    'deleted_at' => NULL,
                    'created_at' => '2024-04-22 11:22:49',
                    'updated_at' => '2024-04-22 11:22:49',
                ),
            1 =>
                array (
                    'id' => 2,
                    'name' => '{"ar":"مدير مالى","en":"مدير مالى"}',
                    'is_active' => 1,
                    'deleted_at' => NULL,
                    'created_at' => '2024-04-22 11:22:50',
                    'updated_at' => '2024-04-22 11:22:50',
                ),
            2 =>
                array (
                    'id' => 3,
                    'name' => '{"ar":"مدير تنفيذى","en":"مدير تنفيذى"}',
                    'is_active' => 1,
                    'deleted_at' => NULL,
                    'created_at' => '2024-04-22 11:22:50',
                    'updated_at' => '2024-04-22 11:22:50',
                ),
            3 =>
                array (
                    'id' => 4,
                    'name' => '{"ar":"مدير المشروع","en":"مدير المشروع"}',
                    'is_active' => 1,
                    'deleted_at' => NULL,
                    'created_at' => '2024-04-22 11:22:50',
                    'updated_at' => '2024-04-22 11:22:50',
                ),
        ));

    }
}
