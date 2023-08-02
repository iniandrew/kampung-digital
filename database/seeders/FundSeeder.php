<?php

namespace Database\Seeders;

use App\Models\Fund;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FundSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $treasurer = User::query()->where('role', User::ROLE_BENDAHARA)->firstOrFail();

        Fund::factory()->count(7)->create([
            'category' => Fund::INCOME,
            'user_id' => $treasurer->id,
        ]);

        Fund::factory()->count(3)->create([
            'category' => Fund::OUTCOME,
            'user_id' => $treasurer->id,
        ]);
    }
}
