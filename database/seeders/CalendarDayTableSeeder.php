<?php

namespace Database\Seeders;

use App\Models\CalendarDay;
use App\Services\Hijri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class CalendarDayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CalendarDay::factory()->count(300)->create();
        // create 10 days starting from $hijriDate = Hijri::Date('Y-m'); for clinic_id = 1
//        $hijriDate = Hijri::Date('Y-m-d');
//        $carbonDate = Carbon::createFromFormat('Y-m-d', $hijriDate);
//        $clinicId = 1;
//        for ($i = 0; $i < 10; $i++) {
//            \DB::table('calendar_days')->insert([
//                'day_date' => $carbonDate->format('Y-m-d'),
//                'clinic_id' => $clinicId,
//            ]);
//            $carbonDate->addDay();
//        }
    }
}
