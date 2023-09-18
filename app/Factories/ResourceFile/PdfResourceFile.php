<?php

namespace App\Factories\ResourceFile;

use Illuminate\Validation\Validator;
use App\Factories\ResourceFile\ResourceFile;

class PdfResourceFile extends ResourceFile
{
    protected string $disk = 'private';
    protected string $path = 'resources/pdf';

    public function validate(Validator $validator): array
    {
        return [
            $validator->sometimes(
                'file',
                'mimes:pdf',
                fn () => true
            )
        ];
    }
}
