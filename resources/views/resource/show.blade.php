<x-layout.app title="Visualizar">

    <section>
        <div class="bg-info">
            <div class="container-xl">
                <div class="row">
                    <div
                        class="col-12 d-flex align-items-center justify-content-center justify-content-md-start px-xl-0 py-5">
                        <h1 class="m-0 fs-1 fw-bold text-center text-md-start text-capitalize text-white">
                            {{ $resource->title }}
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 px-xl-0">
                        <div class="d-flex flex-column flex-md-row align-items-center gap-3 pb-3">
                            <p
                                class="d-flex align-items-center m-0 fw-normal text-center text-md-start text-capitalize text-white fs-09">
                                <i class="bi bi-person me-2 fs-5"></i>
                                Criado por {{ $resource->user->name }}
                            </p>
                            <div class="vr d-none d-md-block bg-white"></div>
                            <p
                                class="d-flex align-items-center m-0 fw-normal text-center text-md-start text-capitalize text-white fs-09">
                                <i class="bi bi-clock-history me-2 fs-5"></i> Última atualização em
                                {{ $resource->updated_at }}
                            </p>
                            <div class="vr d-none d-md-block bg-white"></div>
                            <p
                                class="d-flex align-items-center m-0 fw-normal text-center text-md-start text-capitalize text-white fs-09">
                                <i class="bi bi-globe me-2 fs-5"></i> {{ $resource->language->name }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-info-subtle">
            <div class="container-xl p-0">
                <div class="row m-0">
                    <div class="col px-xl-0">
                        <div class="d-grid gap-3 d-md-flex justify-content-md-start py-4">
                            <a href="{{ route('file.show', $resource->id) }}" target="__blank"
                                class="btn btn-primary px-3 py-2 rounded-1 fw-medium text-capitalize fs-095">
                                <i class="bi bi-eye me-1"></i>
                                Visualizar
                            </a>

                            <!-- Button Trigger Modal Share-->
                            <button type="button"
                                class="btn btn-primary px-3 py-2 rounded-1 fw-medium text-capitalize fs-095"
                                data-bs-toggle="modal" data-bs-target="#modalShare">
                                <i class="bi bi-share me-1"></i>
                                Compartilhar
                            </button>

                            <div class="dropdown-center">
                                <button type="button"
                                    class="btn btn-dark dropdown-toggle w-100 px-3 py-2 rounded-1 fw-medium text-capitalize fs-095"
                                    data-bs-toggle="dropdown">
                                    Outras Ações
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item fs-095"
                                            href="{{ route('file.download', $resource->id) }}">
                                            <i class="bi bi-download me-2"></i>
                                            Baixar
                                        </a>
                                    </li>

                                    @can('update', $resource)
                                        <li>
                                            <a class="dropdown-item fs-095"
                                                href="{{ route('resource.edit', $resource->id) }}">
                                                <i class="bi bi-pencil me-2"></i>
                                                Editar
                                            </a>
                                        </li>
                                    @endcan

                                    @can('delete', $resource)
                                        <li>
                                            <button class="dropdown-item fs-095" data-bs-toggle="modal"
                                                data-bs-target="#modalConfirmDelete">
                                                <i class="bi bi-trash3 me-2"></i>
                                                Excluir
                                            </button>
                                        </li>
                                    @endcan

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xl p-0">
            <div class="row m-0">
                <div class="col px-xl-0 py-5">
                    <div>
                        <div class="mb-5">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Descrição</h2>
                            @if (empty($resource->description))
                                <p class="fw-light fs-095"">Não possui</p>
                            @else
                                <p class="fw-light fs-095">{{ $resource->description }}</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Áreas tecnológicas</h2>
                            <ul>
                                @forelse ($resource->techAreas as $techArea)
                                    <li class="fw-light fs-09">{{ $techArea->name }}</li>
                                @empty
                                    <li class="fw-light fs-09">Não possui.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Cursos</h2>
                            <ul>
                                @forelse ($resource->courses as $course)
                                    <li class="fw-light fs-09">{{ $course->name }}</li>
                                @empty
                                    <li class="fw-light fs-09">Não possui.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Disciplinas</h2>
                            <ul>
                                @forelse ($resource->disciplines as $discipline)
                                    <li class="fw-light fs-09">{{ $discipline->name }}</li>
                                @empty
                                    <li class="fw-light fs-09">Não possui.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Tags</h2>
                            <ul>
                                @forelse ($resource->tags as $tag)
                                    <li class="fw-light fs-09">{{ $tag->name }}</li>
                                @empty
                                    <li class="fw-light fs-09">Não possui.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Share-->
    <div class="modal fade" id="modalShare">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-110">
                        Compartilhar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="d-flex align-items-center justify-content-between fs-095">
                        https://dev.ltiaas.com/lti/launch/?resource={{ $resource->id }}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary px-3 py-2 rounded-1 fw-medium text-capitalize fs-09"
                        data-bs-dismiss="modal">
                        Fechar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Confirm Delete -->
    <div class="modal fade" id="modalConfirmDelete">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-110">
                        <i class="bi bi-exclamation-triangle-fill me-1"></i>
                        Atenção
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body fs-095">
                    Deseja realmente excluir este recurso?
                </div>
                <div class="modal-footer gap-2">
                    <button type="button" class="btn btn-danger px-3 py-2 rounded-1 fw-medium fs-09"
                        data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                        Cancelar
                    </button>
                    <form action="{{ route('resource.destroy', $resource->id) }}" method="POST">
                        @csrf()
                        @method('delete')
                        <button type="submit" class="btn btn-outline-primary px-3 py-2 rounded-1 fw-medium fs-09">
                            <i class="bi bi-check-lg"></i>
                            Confirmar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @if (session('error'))
        <x-toast.error :message="session('error')">
        </x-toast.error>
    @endif

    @if (session('success'))
        <x-toast.success :message="session('success')">
        </x-toast.success>
    @endif

</x-layout.app>
