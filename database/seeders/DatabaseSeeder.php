<?php

namespace Database\Seeders;

use App\Models\BloodBag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Call the UserSeeder first if we want auth set up
        $this->call(UserSeeder::class);

        // Seed 50 realistic blood bags
        BloodBag::factory()->count(50)->create();
    }
}
