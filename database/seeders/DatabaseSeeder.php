<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Complaint;
use App\Models\People;
use App\Models\Agenda;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        People::factory(100)->create();
        $this->call(UserSeeder::class);
        Agenda::factory(100)->create();
        Complaint::factory(20)->create();
        // $this->call(FundSeeder::class);
    }
}
