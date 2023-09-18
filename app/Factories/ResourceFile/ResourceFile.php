<?php

namespace App\Factories\ResourceFile;

use Exception;
use App\Models\Resource;
use Illuminate\Http\UploadedFile;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

abstract class ResourceFile
{
    protected string $disk = 'public';
    protected string $path = 'resources';

    abstract public function validate(Validator $validator): array;

    public function save(UploadedFile $file): string
    {
        $storage = Storage::disk($this->disk);

        return $storage->put($this->path, $file);
    }

    public function get(string $resourceFile, string $file = ''): BinaryFileResponse|Exception
    {
        $storage =  Storage::disk($this->disk);
        $existsFile = $storage->exists($resourceFile);

        if (!$existsFile) {
            return throw new Exception('File does not exist');
        }

        $resourceFile = $storage->path($resourceFile);

        return response()->file($resourceFile);
    }

    public function show(Resource $resource): BinaryFileResponse|View|Exception
    {
        return $this->get($resource->file);
    }

    public function delete(?string $file): bool|Exception
    {
        $storage = Storage::disk($this->disk);
        $existsFile = $storage->exists($file);

        if (!$existsFile) {
            return throw new Exception('File does not exist');
        }

        return $storage->delete($file);
    }

    public function download(string $file): StreamedResponse|BinaryFileResponse|Exception
    {
        $storage = Storage::disk($this->disk);
        $existsFile = $storage->exists($file);

        if (!$existsFile) {
            return throw new Exception('File does not exist');
        }

        return $storage->download($file);
    }
}
