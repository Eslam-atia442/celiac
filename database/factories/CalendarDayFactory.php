<?php

namespace Database\Factories;

use App\Enums\UserTypeEnum;
use App\Models\Clinic;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CalendarDay>
 */
class CalendarDayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clincs = Clinic::pluck('id')->toArray();
        $randomClinicId = $clincs[array_rand($clincs)];
        return [
            'day_date' => fake()->dateTimeBetween('-1 months', '+1 months'),
            'clinic_id' => $randomClinicId,
        ];
    }
}
