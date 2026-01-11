<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create test user
        // Create admin user
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@example.com',
            'role' => 'admin',
            'phone' => '08000000000',
            'password' => 'password',
        ]);

        // Create owner user
        User::factory()->create([
            'name' => 'Venue Owner',
            'email' => 'owner@example.com',
            'role' => 'owner',
            'phone' => '08111111111',
            'password' => 'password',
        ]);

        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'phone' => '081234567890',
        ]);

        // Seed sports and fields
        $this->call([
            SportSeeder::class,
            FieldSeeder::class,
        ]);
    }
}
