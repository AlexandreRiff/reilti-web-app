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
            'password' => '$2y$10$towACVW9k1ORpPwXju3l2uCU7Ko9OvR2w9Rlo60LMG5eogyEKaehG',
        ]);

        User::create([
            'name' => 'Usuario Teste 1',
            'email' => 'usuarioteste1@reilti.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$hSQ3oom3gNsK58b3Bom0seG2/CMwEeGQy9zcjaB8mTo0QtzFk3mI2',
        ]);

        //User::factory()->count(8)->create();
    }
}
