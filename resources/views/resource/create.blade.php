<x-layout.app title="Adicionar">

    <x-slot name="styles">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
        <link rel="stylesheet" href="{{ asset('css/resource/create-edit.css') }}" />
    </x-slot>

    <section>
        <div class="container p-0">
            <div class="row justify-content-center m-0 py-md-5">
                <div class="col-lg-8 col-sm-12 p-0">
                    <h1 class="me-2 px-3 pb-3 pt-5 pt-md-0 fs-3 text-center text-md-start text-capitalize">
                        Adicionar Recurso
                    </h1>

                    <x-form.resource :action="route('resource.store')" method="POST">
                    </x-form.resource>

                </div>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.1/jquery.min.js" type="text/javascript"></script>
        <script src="https://unpkg.com/jszip@3.7.1/dist/jszip.js" type="text/javascript"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js" type="text/javascript"></script>
        <script src="{{ asset('js/resource/create-edit.js') }}" type="text/javascript"></script>
    </x-slot>

</x-layout.app>
