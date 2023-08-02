<?php

namespace Database\Factories;

use App\Models\Complaint;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'status' => $this->faker->randomElement([
                Complaint::STATUS_NEED_REVIEW,
                Complaint::STATUS_IN_PROGRESS,
                Complaint::STATUS_CLOSED,
                Complaint::STATUS_REJECTED,
            ]),
            'user_id' => $this->faker->numberBetween(5, 9),
        ];
    }
}
