<?php

namespace App\Http\Controllers\Resource;

use App\Models\Resource;
use Illuminate\Http\Request;
use App\Services\ResourceService;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StoreResourceRequest;
use App\Http\Requests\UpdateResourceRequest;

class ResourceController extends Controller
{
    public function __construct(private ResourceService $resourceService)
    {
        $this->authorizeResource(Resource::class, 'resource');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $filters = $request->only('title', 'techArea', 'course', 'discipline', 'language', 'tags');

        $resources = $this->resourceService->index($filters);

        return view('resource.index', compact('resources'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('resource.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreResourceRequest $request): RedirectResponse
    {
        $resourceId = $this->resourceService->store($request->validated());

        if ($resourceId) {
            return redirect()->route('resource.show', $resourceId)
                ->withSuccess('recurso criado com sucesso');
        }

        return redirect()->route('resource.index')
            ->withError('não foi possivel criar o recurso');
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource): View
    {
        return view('resource.show')->with('resource', $resource);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource): View
    {
        return view('resource.edit')->with('resource', $resource);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateResourceRequest $request, Resource $resource): RedirectResponse
    {
        $isUpdated = $this->resourceService->update($resource, $request->validated());

        if ($isUpdated) {
            return redirect()->route('resource.show', $resource->id)
                ->withSuccess('recurso atualizado com sucesso');
        }

        return redirect()->route('resource.show', $resource->id)
            ->withError('não foi possível editar o recurso');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Resource $resource): RedirectResponse
    {
        $isDeleted = $this->resourceService->destroy($resource);

        if ($isDeleted) {
            return redirect()->route('resource.index')
                ->withSuccess('recurso excluído com sucesso');
        }

        return redirect()->route('resource.show', $resource->id)
            ->withError('não foi possível excluir o recurso');
    }
}
