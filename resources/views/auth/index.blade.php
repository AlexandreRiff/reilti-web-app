<x-layout.default title="Login">

    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/auth/index.css') }}">
    </x-slot>

    <main class="row align-items-center justify-content-center vh-100 m-0">
        <div class="col d-flex flex-column align-items-center justify-content-center">
            <form action="{{ route('auth.login') }}" method="POST" novalidate
                class="w-100 p-sm-5 p-3 rounded-2 login__form">
                @csrf()

                <img src="{{ asset('img/logotipo.png') }}" alt="Logotipo" class="img-fluid d-block mx-auto mb-5 w-50" />

                <div class="form-floating mb-3">
                    <input type="email" placeholder="" name="email" id="login__email"
                        class="form-control @error('email') is-invalid @enderror"" />
                    <label for="login__email" class="fw-light">Email</label>

                    @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="form-floating mb-3">
                    <input type="password" placeholder="" name="password" id="login__password"
                        class="form-control @error('password') is-invalid @enderror"" />
                    <label for="login__password" class="fw-light">Senha</label>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>
                <div class="form-floating mb-5">
                    <a href="{{ route('password.request') }}" class="fw-light text-decoration-none">Esqueceu sua
                        senha?</a>
                </div>
                <button type="submit" class="btn btn-primary w-100 p-3 rounded-2 fw-semibold text-uppercase">
                    Entrar
                </button>
            </form>
        </div>
    </main>

    @if (session('success'))
        <x-toast class="bg-success-subtle">
            <p class="m-0 fs-6 text-center text-capitalize">
                <i class="bi bi-check-circle-fill me-1"></i>
                {{ session('success') }}
            </p>
        </x-toast>
    @endif

</x-layout.default>
