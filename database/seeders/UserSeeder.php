<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'username' => 'admin',
                'email'    => 'admin@wathba.org',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );
    }
}
