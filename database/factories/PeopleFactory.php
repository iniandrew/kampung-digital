<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\People;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class PeopleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nik' => fake()->numberBetween(1111111111111111, 9999999999999999),
            'family_card_number' => fake()->numberBetween(1111111111111111, 9999999999999999),
            'name' => fake()->name(),
            'date_of_birth' => fake()->date(),
            'place_of_birth' => fake()->country(),
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'religion' => fake()->randomElement([People::RELIGION_ISLAM, People::RELIGION_CATHOLIC, People::RELIGION_PROTESTANT, People::RELIGION_BUDDHA, People::RELIGION_HINDU, People::RELIGION_KONGHUCU]),
            'gender' => fake()->randomElement([People::GENDER_MALE, People::GENDER_FEMALE]),
            'job' => fake()->jobTitle(),
        ];
    }
}
