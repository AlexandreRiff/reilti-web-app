<x-layout.default title="Login">

    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    </x-slot>

    <main class="row align-items-center justify-content-center vh-100 m-0">
        <div class="col d-flex flex-column align-items-center justify-content-center">
            <form action="{{ route('auth.login') }}" method="POST" novalidate class="w-100 p-3 p-sm-5 rounded-2 form">
                @csrf()

                <img src="{{ asset('img/logotipo.png') }}" alt="Logotipo"
                    class="img-fluid d-block mx-auto mb-5 form__logo" />

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
                <div class="form-floating mb-4">
                    <a href="{{ route('password.request') }}" class="fw-light text-decoration-none form__link">
                        Esqueceu sua senha?
                    </a>
                </div>
                <button type="submit"
                    class="btn btn-sm btn-primary w-100 rounded-2 fw-semibold text-uppercase mb-2 p-2">
                    Entrar
                </button>

                <hr />

                <a href="{{ route('auth.register') }}"
                    class="btn btn-sm btn-outline-primary w-100 rounded-2 fw-semibold text-uppercase mt-2 p-2">
                    Cadastre-se
                </a>
            </form>
        </div>
    </main>

    @if (session('error'))
        <x-toast.error :message="session('error')">
        </x-toast.error>
    @endif

    @if (session('success'))
        <x-toast.success :message="session('success')">
        </x-toast.success>
    @endif

</x-layout.default>
