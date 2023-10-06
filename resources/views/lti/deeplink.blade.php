<x-layout.default title="Deeplink">

    <div class="container-xl p-0">
        <main class="row align-items-center justify-content-center vh-100 m-0">
            <div class="col p-0">
                @isset($resources)
                    @foreach ($resources as $resource)
                        <div class="card rounded-0">
                            <div class="card-body p-0">
                                <form action="{{ route('lti.deeplinking.form') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="ltik" value="{{ $ltik ?? '' }}">
                                    <input type="hidden" name="resource" value="{{ $resource->id }}">
                                    <div
                                        class="d-flex flex-column flex-sm-row align-items-center justify-content-between p-3 gap-3">
                                        <h2 class="fs-6 m-0">{{ $resource->title }}</h2>
                                        <button type="submit"
                                            class="btn btn-primary d-flex align-items-center justify-content-center px-3 py-2 rounded-1">
                                            <i class="bi bi-link me-1 fs-5"></i>
                                            Vincular
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>
        </main>
    </div>

    {!! $form ?? '' !!}

</x-layout.default>
