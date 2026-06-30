<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'name' => 'Administrateur DAAK_TECH',
                'email' => null,
                'password' => 'admin12345',
                'role' => 'admin',
            ]
        );
    }
}