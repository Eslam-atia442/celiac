<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PartnersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('partners')->delete();
        
        \DB::table('partners')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '{"en":"Zaria Hyatt"}',
                'partner_group_id' => 3,
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => '{"en":"Elvie Nader Sr."}',
                'partner_group_id' => 1,
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => '{"en":"Kayla Bins"}',
                'partner_group_id' => 3,
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => '{"en":"Diana Strosin"}',
                'partner_group_id' => 1,
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
        ));
        
        
    }
}