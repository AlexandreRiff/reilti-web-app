<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->assignRole('teacher');
        }

        $user = User::firstWhere('email', 'admin@reilti.com');
        $user->assignRole('admin');
    }
}
