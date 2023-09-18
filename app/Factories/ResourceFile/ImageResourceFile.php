<?php

namespace App\Factories\ResourceFile;

use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Factories\ResourceFile\ResourceFile;

class ImageResourceFile extends ResourceFile
{
    protected string $disk = 'public';
    protected string $path = 'resources/thumbnail';

    public function save(UploadedFile $file): string
    {
        $storage = Storage::disk($this->disk);

        $path = $file->hashName($this->path);
        $resizeImage = Image::make($file)->fit(600, 300, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $storage->put($path, $resizeImage->encode(null, 100));

        return $path;
    }

    public function validate(Validator $validator): array
    {
        return [
            $validator->sometimes(
                'file',
                'mimetypes:image',
                fn () => true
            )
        ];
    }
}
