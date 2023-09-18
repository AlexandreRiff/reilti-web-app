<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Resource;
use Illuminate\Database\Seeder;

class ResourceTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $resources = Resource::all();

        foreach ($resources as $resource) {
            $resource->tags()->attach(Tag::pluck('id')->random());
        }
    }
}
