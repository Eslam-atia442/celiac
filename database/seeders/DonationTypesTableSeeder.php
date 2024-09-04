<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DonationTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('donation_types')->delete();
        
        \DB::table('donation_types')->insert(array (
            0 => 
            array (
                'id' => 6,
                'name' => '{"ar":"تبرع عام","en":"تبرع عام"}',
                'text_color' => '#db52a3',
                'background_color' => '#a22e03',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            1 => 
            array (
                'id' => 7,
                'name' => '{"ar":"اهداء لعلاج مريض","en":"اهداء لعلاج مريض"}',
                'text_color' => '#a1f298',
                'background_color' => '#8804c9',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            2 => 
            array (
                'id' => 8,
                'name' => '{"ar":"تدريب وتأهيل المرضي","en":"تدريب وتأهيل المرضي"}',
                'text_color' => '#0adb4e',
                'background_color' => '#0489ee',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            3 => 
            array (
                'id' => 9,
                'name' => '{"ar":"اهداء لعلاج مريض","en":"اهداء لعلاج مريض"}',
                'text_color' => '#d0e9f7',
                'background_color' => '#ffa821',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            4 => 
            array (
                'id' => 10,
                'name' => '{"ar":"تدريب وتأهيل المرضي","en":"تدريب وتأهيل المرضي"}',
                'text_color' => '#c34e50',
                'background_color' => '#c7e035',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
        ));
        
        
    }
}