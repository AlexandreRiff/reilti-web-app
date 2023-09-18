<?php

namespace Database\Seeders;

use App\Enums\Media;
use App\Models\Media as MediaModel;
use Illuminate\Database\Seeder;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (Media::cases() as $media) {
            MediaModel::create([
                'type' => $media->value,
            ]);
        }
    }
}
