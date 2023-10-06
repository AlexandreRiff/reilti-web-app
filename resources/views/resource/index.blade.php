<x-layout.app title="Home">

    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/resource/index.css') }}" />
    </x-slot>

    <div class="container-xl p-0 container-center">
        <aside class="sticky-top px-3 py-md-4 filter__wrapper">
            <div class="offcanvas-md offcanvas-start" id="filter__offcanvas">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Filtrar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        data-bs-target="#filter__offcanvas"></button>
                </div>
                <div class="offcanvas-body flex-column">
                    <form action="{{ route('resource.index') }}" method="GET">
                        <div class="form-floating mb-3">
                            <input type="text" placeholder="" name="title" id="filter__title" class="form-control"
                                value="{{ request('title') }}" />
                            <label for="filter__title" class="fw-light filter__label">Título</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" placeholder="" name="techArea" id="filter__tech-area"
                                class="form-control" value="{{ request('techArea') }}" />
                            <label for="filter__tech-area" class="fw-light filter__label">Área Tecnológica</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" placeholder="" name="course" id="filter__course" class="form-control"
                                value="{{ request('course') }}" />
                            <label for="filter__course" class="fw-light filter__label">Curso</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" placeholder="" name="discipline" id="filter__discipline"
                                class="form-control" value="{{ request('discipline') }}" />
                            <label for="filter__discipline" class="fw-light filter__label">Disciplina</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" placeholder="" name="language" class="form-control"
                                id="filter__language" value="{{ request('language') }}" />
                            <label for="filter__language" class="fw-light filter__label">Idioma</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" placeholder="" name="tags" id="filter__tags" class="form-control"
                                value="{{ request('tags') }}" />
                            <label for="filter__tags" class="fw-light filter__label">Tags</label>
                        </div>
                        <button type="submit"
                            class="btn btn-sm btn-primary d-flex align-items-center justify-content-center w-100 p-2 rounded-1 fw-medium text-capitalize filter__btn">
                            <i class="bi bi-search me-2"></i>
                            Buscar
                        </button>
                    </form>
                </div>
            </div>
        </aside>

        <main class="resources__wrapper p-0">
            <div class="row m-0 px-3 pb-3 ps-md-4 pe-md-0">
                <div
                    class="col-12 sticky-top d-flex flex-column flex-md-row align-items-center gap-4 justify-content-between px-0 py-4 bg-white resources__header">
                    <button
                        class="btn btn-outline-primary align-items-center justify-content-center d-md-none w-100 py-1 rounded-1 fw-bold text-uppercase resources__btn-filter"
                        type="button" data-bs-toggle="offcanvas" data-bs-target="#filter__offcanvas">
                        <i class="bi bi-filter me-1 fs-5"></i>
                        Filtrar
                    </button>
                    <p class="m-0 order-md-2 resources__text-results">{{ $resources->total() }} resultados</p>

                    {{-- <select class="form-select form-select-lg order-md-1 w-100 fw-light resources__select-order">
                        <option selected disabled>Ordenar por</option>
                        <option value="1">Ordem alfabética</option>
                        <option value="2">Últimos adicionados</option>
                    </select> --}}
                </div>

                @forelse ($resources as $resource)
                    <div class="col-xl-4 col-lg-5 col-md-10 col-sm-12 px-0 px-md-2 py-2">
                        <div class="card h-100">
                            <div class="ratio ratio-16x9">

                                @if ($resource->thumbnail)
                                    <img src="{{ Storage::url($resource->thumbnail) }}" alt=""
                                        class="card-img-top" />
                                @else
                                    <img src="{{ asset('img/default.jpg') }}" alt="" class="card-img-top" />
                                @endif

                            </div>
                            <div class="card-body">
                                <h5 class="card-title fw-semibold text-capitalize resources-card__title">
                                    {{ $resource->title }}
                                </h5>
                                @if (empty($resource->description))
                                    <p class="card-text fw-light resources-card__text text-capitalize">
                                        Sem descrição.
                                    </p>
                                @else
                                    <p class="card-text fw-light resources-card__text text-capitalize">
                                        {{ $resource->description }}
                                    </p>
                                @endif
                            </div>
                            <div
                                class="card-footer d-flex align-items-center justify-content-between py-3 bg-transparent border-0">
                                <p class="card-text fw-light m-0">
                                    <small
                                        class="text-body-secondary resources-card__text--small">{{ $resource->updated_at }}</small>
                                </p>
                                <a href="{{ route('resource.show', $resource->id) }}"
                                    class="btn btn-sm btn-outline-primary rounded-1 text-capitalize resources-card__btn">
                                    <i class="bi bi-eye-fill me-1"></i>
                                    Ver mais
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col">
                        <p class="m-0 text-center">
                            Nenhum recurso encontrado.
                        </p>
                    </div>
                @endforelse

                <div class="col-12 px-0 px-md-2 pt-4">
                    {{ $resources->onEachSide(2)->links() }}
                </div>
            </div>
        </main>
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
