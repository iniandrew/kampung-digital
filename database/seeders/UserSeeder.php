<?php

namespace Database\Seeders;

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
                'email' => strtolower($role) . "@mail.com",
                'password' => Hash::make('password'),
                'role' => $role
            ]);

            $this->command->info('User ' . $role . ' created');
        });
    }
}
