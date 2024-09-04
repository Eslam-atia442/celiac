<?php

namespace Database\Factories;

use App\Enums\GenderEnum;
use App\Enums\ReservationTypeEnum;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = \App\Models\User::where('type', UserTypeEnum::user->value)->pluck('id')->toArray();
        $clincs = \App\Models\Clinic::pluck('id')->toArray();

        // get random user from $users array
        $randomUserId = $users[array_rand($users)];
        $randomClinicId = $clincs[array_rand($clincs)];


        return [
            'user_id' => $randomUserId,
            'clinic_id' => $randomClinicId,
            'reservation_number' => fake()->numberBetween(1000000, 9999999) . '-' .
                fake()->dateTimeBetween('-1 years', '+1 years')->getTimestamp(),
            'type' => fake()->randomElement([ReservationTypeEnum::online->value, ReservationTypeEnum::onsite->value]),
            'scheduled_date' => fake()->dateTimeBetween('-1 years', '+1 years'),
            'scheduled_time' => fake()->dateTimeBetween('-1 years', '+1 years'),
            'patient_name' => fake('ar_SA')->name(),
            'patient_phone' => fake()->phoneNumber(),
            'gender' =>  fake()->randomElement([GenderEnum::male->value, GenderEnum::female->value]),
            'email' => fake()->email(),
            'dob' => fake()->dateTimeBetween('-1 years', '+1 years'),
            'is_saudi' => fake()->boolean(),
            'national_id' => fake()->numberBetween(1000000000, 9999999999),
            'residency_number' =>  fake()->numberBetween(1000000000, 9999999999),
        ];
    }
}
