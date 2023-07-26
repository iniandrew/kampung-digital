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
            'user_id' => fake()->numberBetween(11111, 99999),
            'title' => fake()->randomElement([Agenda::TITLE_KERJA_BAKTI, Agenda::TITLE_MAKAN, Agenda::TITLE_KONDANGAN, Agenda::TITLE_LOMBA, Agenda::TITLE_KARANG_TARUNA, Agenda::TITLE_PENTAS_SENI]),
            'content' => fake()->name(),
            'start_date' => fake()->date(),
            'end_date' => fake()->date(),
            'venue' => fake()->address(),
            'status' => fake()->randomElement([Agenda::STATUS_DONE, Agenda::STATUS_NOT_YET]),
        ];
    }
}
