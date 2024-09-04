<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GovernanceListsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('governance_lists')->delete();
        
        \DB::table('governance_lists')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"ar":"القوائم المالية","en":"القوائم المالية"}',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:49',
                'updated_at' => '2024-04-22 11:22:49',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"ar":"الأدلة الارشادية","en":"الأدلة الارشادية"}',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"ar":"التقارير السنوية","en":"التقارير السنوية"}',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"ar":"السياسات","en":"السياسات"}',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '{"ar":"اللوائح","en":"اللوائح"}',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
        ));
        
        
    }
}