<?php

namespace App\Http\Controllers\Lti;

use Exception;
use App\Models\Resource;
use App\Services\LtiService;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use App\Services\ResourceFileService;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class LtiController extends Controller
{
    public function __construct(private LtiService $ltiService)
    {
    }

    public function launch(Request $request, ResourceFileService $resourceFileService): View|BinaryFileResponse|Exception
    {
        $resource = Resource::find($request->resource);

        if (is_null($resource)) {
            abort(404, 'Resource not found');
        }

        session()->put('resource', $request->resource);

        return $resourceFileService->show($resource);
    }

    public function deeplink(Request $request): View
    {
        $ltik = $request->ltik;
        $resources = Resource::where('visibility', 'public')->paginate(5);

        return view('lti.deeplink', compact('resources', 'ltik'));
    }

    public function deeplinkingForm(Request $request): View
    {
        $resource = Resource::find($request->resource);

        if (is_null($resource)) {
            abort(404, 'Resource not found');
        }

        $ltik = $request->ltik;

        $form = $this->ltiService->deeplinkForm($resource, $ltik);

        return view('lti.deeplink', compact('form'));
    }
}
