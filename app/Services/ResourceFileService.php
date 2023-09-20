<?php

namespace App\Services;

use Exception;
use App\Models\Resource;
use Illuminate\Contracts\View\View;
use App\Factories\ResourceFile\ResourceFileFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResourceFileService
{
    public function __construct(private ResourceFileFactory $resourceFileFactory)
    {
    }

    public function get(Resource $resource, string $file = ''): BinaryFileResponse|Exception
    {
        $resourceFile = $resource->file;

        $fileResource = $this->resourceFileFactory->make($resource->media->type);
        return $fileResource->get($resourceFile, $file);
    }

    public function download(Resource $resource): StreamedResponse|BinaryFileResponse|Exception
    {
        $file = $resource->file;

        $fileResource = $this->resourceFileFactory->make($resource->media->type);
        return $fileResource->download($file);
    }

    public function show(Resource $resource): BinaryFileResponse|View|Exception
    {
        $fileResource = $this->resourceFileFactory->make($resource->media->type);
        return $fileResource->show($resource);
    }
}
