<x-layout.default title="Redefinir Senha">

    <x-slot name="styles">
        <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    </x-slot>

    <main class="row align-items-center justify-content-center vh-100 m-0">
        <div class="col d-flex flex-column align-items-center justify-content-center">
            <form action="{{ route('password.update') }}" method="POST" novalidate
                class="w-100 p-sm-5 p-3 rounded-2 form">

                <img src="{{ asset('img/logotipo.png') }}" alt="Logotipo"
                    class="img-fluid d-block mx-auto mb-5 form__logo" />

                @csrf()
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                @if (session('error'))
                    <div class="alert alert-danger text-center fs-09" role="alert">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="form-floating mb-3">
                    <input type="password" placeholder="" name="password" id="login__password"
                        class="form-control @error('password') is-invalid @enderror" />
                    <label for="login__password" class="text-capitalize fw-light">Nova Senha</label>

                    @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror

                </div>

                <div class="form-floating mb-4">
                    <input type="password" placeholder="" name="password_confirmation" id="login__password-confirmation"
                        class="form-control @error('password') is-invalid @enderror" />
                    <label for="login__password-confirmation" class="text-capitalize fw-light">Confirmar Nova
                        Senha</label>
                </div>
                <button type="submit" class="btn btn-sm btn-primary w-100 p-2 rounded-2 fw-semibold text-uppercase">
                    Redefinir Senha
                </button>
            </form>
        </div>
    </main>

</x-layout.default>
