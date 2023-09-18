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
            'password' => '@Admin#!.2023',
        ]);

        User::create([
            'name' => 'Alexandre Riff da Costa',
            'email' => 'alexandre.rdcosta@gmail.com',
            'email_verified_at' => now(),
            'password' => '05121995',
        ]);

        User::factory()->count(8)->create();
    }
}
