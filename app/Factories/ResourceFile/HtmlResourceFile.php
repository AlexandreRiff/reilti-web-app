<?php

namespace App\Factories\ResourceFile;

use Exception;
use Illuminate\Support\Str;
use ZanySoft\Zip\Facades\Zip;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Storage;
use App\Factories\ResourceFile\ResourceFile;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HtmlResourceFile extends ResourceFile
{
    protected string $disk = 'private';
    protected string $path = 'resources/html';

    public function validate(Validator $validator): array
    {
        return [
            $validator->sometimes(
                'file',
                'bail|mimes:zip',
                fn () => true
            ),
            $validator->sometimes(
                'fileInitial',
                'required|string',
                fn () => isset($validator->safe()->file)
            ),
            function () use ($validator) {
                if (isset($validator->safe()->file)) {
                    $file = $validator->safe()->file;
                    $fileInitial = $validator->safe()->fileInitial;

                    $zip = Zip::open($file);

                    // * remove the first /
                    $fileInitial = Str::after($fileInitial, '/');

                    $fileExists = array_search($fileInitial, $zip->listFiles());

                    if (!$fileExists) {
                        $validator->errors()->add(
                            'fileInitial',
                            'Arquivo de incialização inválido'
                        );
                    }
                }
            },
        ];
    }

    public function save(UploadedFile $file): string
    {
        // * remove the extension
        $pathHashName = Str::remove(".{$file->extension()}", $file->hashName());

        $destination = storage_path("app/private/{$this->path}/{$pathHashName}");

        $zip = Zip::open($file);

        $zip->extract($destination);
        $zip->close();

        return "{$this->path}/{$pathHashName}";
    }

    public function get(string $resourceFile, string $file = ''): BinaryFileResponse|Exception
    {
        if (!empty($file)) {
            $storage =  Storage::disk($this->disk);

            // * takes only the root folder of the resource and concatenates it with the requested file
            $file = "{$this->path}/" . Str::betweenFirst($resourceFile, "{$this->path}/", '/') . "/{$file}";

            $existsFile = $storage->exists($file);

            if (!$existsFile) {
                return throw new Exception('File does not exist');
            }

            $headers = [];

            if (Str::contains($file, '.css')) {
                $headers = ['Content-Type' => 'text/css'];
            }

            if (Str::contains($file, '.js')) {
                $headers = ['Content-Type' => 'text/javascript'];
            }

            $file = $storage->path($file);

            return response()->file($file, $headers);
        }

        return parent::get($resourceFile);
    }

    public function delete(?string $file): bool|Exception
    {
        $storage = Storage::disk($this->disk);

        // * only takes the root folder of the resource
        $file = "{$this->path}/" . Str::betweenFirst($file, "{$this->path}/", '/');

        $existsFile = $storage->exists($file);

        if (!$existsFile) {
            return throw new Exception('File does not exist');
        }

        return $storage->deleteDirectory($file);
    }

    public function download(string $file): StreamedResponse|BinaryFileResponse|Exception
    {
        $storage = Storage::disk($this->disk);

        // * only takes the root folder of the resource
        $file = "{$this->path}/" . Str::betweenFirst($file, "{$this->path}/", '/');

        $existsFile = $storage->exists($file);

        if (!$existsFile) {
            return throw new Exception('File does not exist');
        }

        $filename = public_path('file.zip');

        $zip = Zip::create($filename, true);
        $zip->add(storage_path('app/private/' . $file), true);
        $zip->close();

        return response()->download($filename)->deleteFileAfterSend();
    }
}
