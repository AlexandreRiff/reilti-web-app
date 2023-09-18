<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            'pt-br' => 'Português Brasil',
            'en' => 'Inglês',
            'es' => 'Espanhol',
            'fr' => 'Francês',
            'de' => 'Alemão',
            'it' => 'Italiano',
            'libras' => 'Libras',
            'outros' => 'Outros',
        ];

        foreach ($languages as $key => $language) {
            Language::create([
                'name' => $language,
                'abbreviation' => $key,
            ]);
        }
    }
}
