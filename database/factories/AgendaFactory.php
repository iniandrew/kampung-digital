<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Agenda;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\People>
 */
class AgendaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => '1',
            'title' => fake()->word(),
            'content' => fake()->paragraph(),
            'venue' => fake()->streetAddress(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'start_time' => fake()->time(),
            'end_time' => fake()->time(),
            'status' => fake()->randomElement([Agenda::STATUS_ARCHIVE ,Agenda::STATUS_DONE, Agenda::STATUS_COMMING_SOON]),
        ];
    }
}
