<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@bloodbank.com',
            'password' => Hash::make('password'),
        ]);

        // We can generate an API token for testing
        // $token = $user->createToken('admin-token')->plainTextToken;
    }
}
