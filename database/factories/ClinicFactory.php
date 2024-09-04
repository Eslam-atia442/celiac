<?php

namespace Database\Factories;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClinicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
     protected $model = Clinic::class;
    public function definition(): array
    {
         return [
            'name' => fake('ar_EG')->name('male'),
            'number_of_doctors' => fake('ar_SA')->numberBetween(5, 30),
            'duration' => 30,
            'shift_type' => fake()->numberBetween(0, 1),
            'location' => fake('ar_SA')->address(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
        ];
    }
}
