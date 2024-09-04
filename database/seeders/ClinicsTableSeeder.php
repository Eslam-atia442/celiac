<?php

namespace Database\Seeders;

use App\Models\Clinic;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClinicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clinics = [
            [
                'name' => 'Clinic 1',
                'number_of_doctors' => 5,
                'duration' => 30,
                'shift_type' => 1,
                'location' => 'Location 1',
                'start_time' => '08:00:00',
                'end_time' => '16:00:00',
            ],
            [
                'name' => 'Clinic 2',
                'number_of_doctors' => 3,
                'duration' => 20,
                'shift_type' => 2,
                'location' => 'Location 2',
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
            ],
            [
                'name' => 'Clinic 3',
                'number_of_doctors' => 4,
                'duration' => 15,
                'shift_type' => 3,
                'location' => 'Location 3',
                'start_time' => '10:00:00',
                'end_time' => '18:00:00',
            ],
        ];

        foreach ($clinics as $clinic) {
            Clinic::create($clinic);
        }
    }
}
