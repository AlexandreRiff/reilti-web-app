<?php

namespace App\Http\Controllers\ResourceFile;

use Exception;
use App\Models\Resource;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Services\ResourceFileService;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ResourceFileController extends Controller
{
    public function __construct(private ResourceFileService $resourceFileService)
    {
    }

    public function get(Resource $resource, string $file = ''): BinaryFileResponse|Exception
    {
        return $this->resourceFileService->get($resource, $file);
    }

    public function download(Resource $resource): StreamedResponse|BinaryFileResponse|Exception
    {
        return $this->resourceFileService->download($resource);
    }

    public function show(Resource $resource): BinaryFileResponse|View|Exception
    {
        return $this->resourceFileService->show($resource);
    }
}
