<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\People;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = collect([
            User::ROLE_SUPER_ADMIN,
            User::ROLE_ADMIN,
            User::ROLE_BENDAHARA,
            User::ROLE_WARGA,
        ]);

        $roles->each(function ($role) {
            User::query()->create([
                'name' => $role,
                'email' => str_replace(' ', '_', strtolower($role)) . '@mail.com',
                'password' => (env('APP_ENV') !== 'local') ? Hash::make('secretP4sswd123!') : Hash::make('password'),
                'role' => $role
            ]);

            $this->command->info('User ' . $role . ' created');
        });

        People::query()->take(5)->get()->each(function ($people) {
            User::query()->create([
                'name' => $people->name,
                'email' => str_replace(' ', '_', strtolower($people->name)) . '@mail.com',
                'password' => (env('APP_ENV') !== 'local') ? Hash::make('secretP4sswd123!') : Hash::make('password'),
                'role' => User::ROLE_WARGA,
                'people_id' => $people->id
            ]);

            $this->command->info('User warga ' . $people->name . ' created');
        });
    }
}
