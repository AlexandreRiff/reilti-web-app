<x-layout.default title="Recuperar Senha">

    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    </x-slot>

    <main class="row align-items-center justify-content-center vh-100 m-0">
        <div class="col d-flex flex-column align-items-center justify-content-center">
            <form action="{{ route('password.request') }}" method="POST" novalidate
                class="w-100 p-3 p-sm-5 rounded-2 form">

                <img src="{{ asset('img/logotipo.png') }}" alt="Logotipo"
                    class="img-fluid d-block mx-auto mb-5 form__logo" />

                @if (session('success'))
                    <div class="alert alert-success text-center fs-09">
                        {{ session('success') }}
                    </div>
                @else
                    @csrf()

                    @if (session('error'))
                        <div class="alert alert-danger text-center fs-09">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-floating mb-4">
                        <input type="email" placeholder="" name="email" id="login__email"
                            class="form-control @error('email') is-invalid @enderror" />
                        <label for="login__email" class="fw-light text-capitalize">Email</label>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit"
                        class="btn btn-sm btn-primary w-100 mb-4 p-2 rounded-2 fw-semibold text-uppercase">
                        Enviar Email
                    </button>
                    <a href="{{ route('auth.index') }}"
                        class="d-block fw-semibold text-center text-uppercase text-decoration-none form__link">
                        Voltar
                    </a>
                @endif

            </form>
        </div>
    </main>

</x-layout.default>
