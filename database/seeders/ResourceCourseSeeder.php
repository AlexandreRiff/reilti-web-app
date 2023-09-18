<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = Resource::all();

        foreach ($resources as $resource) {
            $resource->courses()->attach(Course::pluck('id')->random());
        }
    }
}
