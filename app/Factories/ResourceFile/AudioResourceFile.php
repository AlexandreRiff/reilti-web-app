<?php

namespace App\Factories\ResourceFile;

use App\Models\Resource;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Validator;
use App\Factories\ResourceFile\ResourceFile;

class AudioResourceFile extends ResourceFile
{
    protected string $disk = 'private';
    protected string $path = 'resources/audio';

    public function show(Resource $resource): View
    {
        return view('resource.file.audio', compact('resource'));
    }

    public function validate(Validator $validator): array
    {
        return [
            $validator->sometimes(
                'file',
                'mimetypes:audio/*',
                fn () => true
            )
        ];
    }
}
