<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PartnerGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('partner_groups')->delete();

        \DB::table('partner_groups')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => '{"ar":"الشريك الذهبي","en":"الشريك الذهبي"}',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => '{"ar":"الشريك الرسمى","en":"الشريك الرسمى"}',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => '{"ar":"الشريك البلاتيني","en":"الشريك البلاتيني"}',
                'is_active' => 1,
                'deleted_at' => NULL,
                'created_at' => '2024-04-22 11:22:50',
                'updated_at' => '2024-04-22 11:22:50',
            ),
        ));


    }
}
