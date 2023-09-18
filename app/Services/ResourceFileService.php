<?php

namespace App\Services;

use App\Models\Resource;
use App\Factories\ResourceFile\ResourceFileFactory;

class ResourceFileService
{
    public function __construct(private ResourceFileFactory $resourceFileFactory)
    {
    }

    public function get(Resource $resource, string $file = '')
    {
        $resourceFile = $resource->file;

        $fileResource = $this->resourceFileFactory->make($resource->media->type);
        return $fileResource->get($resourceFile, $file);
    }

    public function download(Resource $resource)
    {
        $file = $resource->file;

        $fileResource = $this->resourceFileFactory->make($resource->media->type);
        return $fileResource->download($file);
    }

    public function show(Resource $resource)
    {
        $fileResource = $this->resourceFileFactory->make($resource->media->type);
        return $fileResource->show($resource);
    }
}
