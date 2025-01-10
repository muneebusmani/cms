<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@example.com',
            'is_admin' => true,
            'status' => 'approved',
        ]);

        // Approved User
        User::factory()->create([
            'name' => 'Approved User',
            'email' => 'user1@example.com',
            'status' => 'approved',
        ]);


        // Pending User
        User::factory()->create([
            'name' => 'Pending User',
            'email' => 'user2@example.com',
            'status' => 'pending',
        ]);

        // Rejected User
        User::factory()->create([
            'name' => 'Rejected User',
            'email' => 'user3@example.com',
            'status' => 'rejected',
        ]);

    }
}
