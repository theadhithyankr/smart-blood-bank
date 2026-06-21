<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@bloodbank.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'City Hospital',
            'email' => 'hospital@bloodbank.com',
            'password' => Hash::make('password'),
            'role' => 'hospital',
        ]);

        User::factory()->create([
            'name' => 'John Donor',
            'email' => 'donor@bloodbank.com',
            'password' => Hash::make('password'),
            'role' => 'donor',
        ]);

        // We can generate an API token for testing
        // $token = $user->createToken('admin-token')->plainTextToken;
    }
}
