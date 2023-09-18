<?php

namespace App\Http\Controllers\ResourceFile;

use App\Models\Resource;
use App\Http\Controllers\Controller;
use App\Services\ResourceFileService;

class ResourceFileController extends Controller
{
    public function __construct(private ResourceFileService $resourceFileService)
    {
    }

    public function get(Resource $resource, string $file = '')
    {
        return $this->resourceFileService->get($resource, $file);
    }

    public function download(Resource $resource)
    {
        return $this->resourceFileService->download($resource);
    }

    public function show(Resource $resource)
    {
        return $this->resourceFileService->show($resource);
    }
}
