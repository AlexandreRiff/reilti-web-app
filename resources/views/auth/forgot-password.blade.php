<x-layout.default title="Redefinir Senha">

    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/auth/index.css') }}">
    </x-slot>

    <main class="row align-items-center justify-content-center vh-100 m-0">
        <div class="col d-flex flex-column align-items-center justify-content-center">
            <form action="{{ route('password.request') }}" method="POST" novalidate
                class="w-100 p-sm-5 p-3 rounded-2 login__form">

                <img src="{{ asset('img/logotipo.png') }}" alt="Logotipo" class="img-fluid d-block mx-auto mb-5 w-50" />

                @if (session('success'))
                    <div class="alert alert-success text-center" role="alert">
                        {{ session('success') }}
                    </div>
                @else
                    @csrf()

                    @if (session('error'))
                        <div class="alert alert-danger text-center" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="form-floating mb-5">
                        <input type="email" placeholder="" name="email" id="login__email"
                            class="form-control @error('email') is-invalid @enderror" />
                        <label for="login__email" class="fw-light">Email</label>

                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 p-3 rounded-2 fw-semibold text-uppercase mb-3">
                        Redefinir senha
                    </button>
                    <a href="{{ route('auth.index') }}"
                        class="d-block fw-semibold text-center text-uppercase text-decoration-none">
                        Voltar
                    </a>
                @endif

            </form>
        </div>
    </main>

</x-layout.default>
