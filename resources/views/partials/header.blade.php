<header class="sticky-top bg-white border-bottom">
    <nav class="navbar py-4">
        <div class="container p-md-0 navbar__container">
            <a class="navbar-brand p-0 m-0" class="navbar__logo" href="{{ route('resource.index') }}">

                <img src="{{ asset('img/logotipo.png') }}" alt="Logotipo" height="50px" />
            </a>
            <nav class="nav navbar__nav">
                <a href="{{ route('resource.index') }}" class="nav-link text-capitalize">Explorar</a>
            </nav>
            <div class="d-flex align-items-center justify-content-end navbar__buttons">
                <a href="{{ route('resource.create') }}"
                    class="btn btn-primary d-flex align-items-center justify-content-center me-2 me-md-4 px-md-3 py-md-2 rounded-5 fw-semibold text-uppercase navbar__btn-plus">
                    <i class="bi bi-plus-lg d-md-none me-md-1 fs-5"></i>
                </a>

                <div class="dropdown-center">
                    <button type="button" class="btn btn-primary dropdown-toggle rounded-5 fs-5 button-user"
                        type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end rounded-1 shadow button-user__dropdown">
                        <li>
                            <span class="dropdown-item-text fw-medium button-user-dropdown__item">
                                {{ auth()->user()->name }}
                            </span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a href="{{ route('auth.logout') }}"
                                class="dropdown-item text-danger button-user-dropdown__item">Sair</a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </nav>
</header>
