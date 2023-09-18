<?php

namespace Database\Seeders;

use App\Models\Resource;
use App\Models\TechArea;
use Illuminate\Database\Seeder;

class ResourceTechAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = Resource::all();

        foreach ($resources as $resource) {
            $resource->techAreas()->attach(TechArea::pluck('id')->random());
        }
    }
}
