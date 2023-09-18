<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Resource;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ResourceDisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = Resource::all();

        foreach ($resources as $resource) {
            $resource->disciplines()->attach(Discipline::pluck('id')->random());
        }
    }
}
