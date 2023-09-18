<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Language;
use App\Models\Media;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resource>
 */
class ResourceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'language_id' => Language::pluck('id')->random(),
            'description' => fake()->text(),
            'media_id' => Media::firstWhere('type', 'PDF')->id,
            'file' => "resources/pdf/" . fake()->file(storage_path('app/private/resources/pdfFake'), storage_path('app/private/resources/pdf'), false),
            'thumbnail' => "resources/thumbnail/" . fake()->image(storage_path('app/public/resources/thumbnail'), 600, 300, null, false),
            'visibility' => fake()->randomElement(['public', 'private']),
            'user_id' => User::pluck('id')->random(),
        ];
    }
}
