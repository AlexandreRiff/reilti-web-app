<?php

namespace App\Factories\ResourceFile;

use App\Enums\Media;
use Exception;
use App\Factories\ResourceFile\ResourceFile;
use App\Factories\ResourceFile\PdfResourceFile;
use App\Factories\ResourceFile\HtmlResourceFile;
use App\Factories\ResourceFile\AudioResourceFile;
use App\Factories\ResourceFile\ImageResourceFile;

class ResourceFileFactory
{
    public function make(string $type): ResourceFile|Exception
    {
        return match ($type) {
            Media::HTML->value => new HtmlResourceFile,
            Media::PDF->value => new PdfResourceFile,
            Media::AUDIO->value => new AudioResourceFile,
            'IMAGE' => new ImageResourceFile,
            default => throw new Exception('Unknown type')
        };
    }
}
