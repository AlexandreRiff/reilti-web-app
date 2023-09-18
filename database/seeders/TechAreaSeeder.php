<?php

namespace Database\Seeders;

use App\Models\TechArea;
use Illuminate\Database\Seeder;

class TechAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TechArea::factory()->count(10)->create();
    }
}
