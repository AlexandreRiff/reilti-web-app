<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@reilti.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$dwpRUBKao/U6P4RksUbotOE2hcSvNNSEGbJ3096QBTfEycVyX4ooK', // admin
        ]);

        //User::factory()->count(8)->create();
    }
}
