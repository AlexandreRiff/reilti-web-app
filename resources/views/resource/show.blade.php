<x-layout.app title="Visualizar">

    <section>
        <div class="bg-info">
            <div class="container-xl">
                <div class="row">
                    <div
                        class="col-12 d-flex align-items-center justify-content-md-start justify-content-center px-xl-0 py-5">
                        <h1 class="m-0 fs-1 fw-bold text-center text-md-start text-white text-capitalize">
                            {{ $resource->title }}
                        </h1>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 px-xl-0">
                        <div class="d-flex flex-md-row flex-column align-items-center gap-3 pb-3">
                            <p
                                class="d-flex align-items-center m-0 fw-normal text-center text-md-start text-capitalize text-white">
                                <i class="bi bi-person me-2"></i> Criado por {{ $resource->user->name }}
                            </p>
                            <div class="vr d-md-block d-none bg-white"></div>
                            <p
                                class="d-flex align-items-center m-0 fw-normal text-center text-md-start text-capitalize text-white">
                                <i class="bi bi-clock-history me-2"></i> Última atualização em
                                {{ $resource->updated_at }}
                            </p>
                            <div class="vr d-none d-md-block bg-white"></div>
                            <p
                                class="d-flex align-items-center m-0 fw-normal text-center text-md-start text-capitalize text-white">
                                <i class="bi bi-globe me-2"></i> {{ $resource->language->name }}
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
                                class="btn btn-primary rounded-1
                            fw-medium text-capitalize py-2">
                                <i class="bi bi-eye me-1"></i>
                                Visualizar
                            </a>
                            <button type="button"
                                class="btn btn-primary rounded-1 fw-medium text-capitalize py-2 d-none">
                                <i class="bi bi-share me-1"></i>
                                Compartilhar
                            </button>


                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary rounded-1 fw-medium text-capitalize py-2"
                                data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <i class="bi bi-share me-1"></i>
                                Compartilhar
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Compartilhar</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                https://dev.ltiaas.com/lti/launch/?resource={{ $resource->id }}
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button"
                                                class="btn btn-primary rounded-1 fw-medium text-capitalize py-2"
                                                data-bs-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="dropdown-center">
                                <button type="button"
                                    class="btn btn-outline-dark dropdown-toggle py-2 rounded-1 fw-medium text-capitalize w-100"
                                    data-bs-toggle="dropdown">
                                    Outras Ações
                                </button>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('file.download', $resource->id) }}">
                                            <i class="bi bi-download me-2"></i>
                                            Baixar
                                        </a>
                                    </li>

                                    @can('update', $resource)
                                        <li>
                                            <a class="dropdown-item" href="{{ route('resource.edit', $resource->id) }}">
                                                <i class="bi bi-pencil me-2"></i>
                                                Editar
                                            </a>
                                        </li>
                                    @endcan


                                    @can('delete', $resource)
                                        <li>
                                            <form action="{{ route('resource.destroy', $resource->id) }}" method="POST">
                                                @csrf()
                                                @method('delete')
                                                <button class="dropdown-item">
                                                    <i class="bi bi-trash3 me-2"></i>
                                                    Excluir
                                                </button>
                                            </form>
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
                    <div id="accordionDetailsResource" class="accordion d-none">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed fw-semibold text-capitalize"
                                    data-bs-toggle="collapse" data-bs-target="#collapse1">
                                    Descrição
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse"
                                data-bs-parent="#accordionDetailsResource">
                                <div class="accordion-body">
                                    @if (empty($resource->description))
                                        <p class="m-0 fw-light">Não possui</p>
                                    @else
                                        <p class="m-0 fw-light">{{ $resource->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed fw-semibold text-capitalize"
                                    data-bs-toggle="collapse" data-bs-target="#collapse2">
                                    Áreas tecnológicas
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse"
                                data-bs-parent="#accordionDetailsResource">
                                <div class="accordion-body">
                                    <ul class="m-0">
                                        @forelse ($resource->techAreas as $techArea)
                                            <li>{{ $techArea->name }}</li>
                                        @empty
                                            <li>Não possui.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed fw-semibold text-capitalize"
                                    data-bs-toggle="collapse" data-bs-target="#collapse3">
                                    Cursos
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse"
                                data-bs-parent="#accordionDetailsResource">
                                <div class="accordion-body">
                                    <ul class="m-0">
                                        @forelse ($resource->courses as $course)
                                            <li>{{ $course->name }}</li>
                                        @empty
                                            <li>Não possui.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed fw-semibold text-capitalize"
                                    data-bs-toggle="collapse" data-bs-target="#collapse4">
                                    Disciplinas
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse"
                                data-bs-parent="#accordionDetailsResource">
                                <div class="accordion-body">
                                    <ul class="m-0">
                                        @forelse ($resource->disciplines as $discipline)
                                            <li>{{ $discipline->name }}</li>
                                        @empty
                                            <li>Não possui.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button type="button" class="accordion-button collapsed fw-semibold text-capitalize"
                                    data-bs-toggle="collapse" data-bs-target="#collapse5">
                                    Tags
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse"
                                data-bs-parent="#accordionDetailsResource">
                                <div class="accordion-body">
                                    <ul class="m-0">
                                        @forelse ($resource->tags as $tag)
                                            <li>{{ $tag->name }}</li>
                                        @empty
                                            <li>Não possui.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="mb-5">
                            <h2 class="fs-5 fw-semibold text-capitalize text-secondary">Descrição</h2>
                            @if (empty($resource->description))
                                <p class="fw-light">Não possui</p>
                            @else
                                <p class="fw-light">{{ $resource->description }}</p>
                            @endif
                        </div>
                        <div class="mb-4">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Áreas tecnológicas</h2>
                            <ul>
                                @forelse ($resource->techAreas as $techArea)
                                    <li class="fw-light">{{ $techArea->name }}</li>
                                @empty
                                    <li class="fw-light">Não possui.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Cursos</h2>
                            <ul>
                                @forelse ($resource->courses as $course)
                                    <li class="fw-light">{{ $course->name }}</li>
                                @empty
                                    <li class="fw-light">Não possui.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Disciplinas</h2>
                            <ul>
                                @forelse ($resource->disciplines as $discipline)
                                    <li class="fw-light">{{ $discipline->name }}</li>
                                @empty
                                    <li class="fw-light">Não possui.</li>
                                @endforelse
                            </ul>
                        </div>
                        <div class="mb-4">
                            <h2 class="fs-6 fw-semibold text-capitalize text-secondary">Tags</h2>
                            <ul>
                                @forelse ($resource->tags as $tag)
                                    <li class="fw-light">{{ $tag->name }}</li>
                                @empty
                                    <li class="fw-light">Não possui.</li>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (session('error'))
        <x-toast class="bg-danger-subtle">
            <p class="m-0 fs-6 text-center text-capitalize">
                <i class="bi bi-exclamation-triangle-fill me-1"></i>
                {{ session('error') }}
            </p>
        </x-toast>
    @endif

    @if (session('success'))
        <x-toast class="bg-success-subtle">
            <p class="m-0 fs-6 text-center text-capitalize">
                <i class="bi bi-check-circle-fill me-1"></i>
                {{ session('success') }}
            </p>
        </x-toast>
    @endif

</x-layout.app>
