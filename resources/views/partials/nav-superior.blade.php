<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    <img src="{{ asset('img/logo_epc.webp') }}" alt="logo" style="width: 50px; height: 50px; border-radius: 50%;">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Botón de alertas -->
                        @auth
                        <li class="nav-item dropdown me-2">
                            <a id="alertDropdown" class="nav-link dropdown-toggle position-relative" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="bi bi-bell" style="font-size: 1.5rem;"></i>
                                {{-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">{{ Auth::user()->alertas()->unread()->count() }}</span> --}}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="alertDropdown" style="min-width: 300px;">
                                <span class="dropdown-item-text fw-bold">Alertas</span>
                                <div class="dropdown-divider"></div>
                                @php
                                    $alertas = Auth::user()->alertas()->latest()->take(3)->get();
                                @endphp
                                @forelse($alertas as $alerta)
                                    <span class="dropdown-item text-wrap">{{ $alerta->mensaje ?? $alerta->titulo ?? 'Alerta' }}</span>
                                @empty
                                    <span class="dropdown-item">No hay alertas nuevas.</span>
                                @endforelse
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('alertas.index') }}" class="dropdown-item text-center text-primary">Ver más</a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->persona->primer_nombre }} {{ Auth::user()->persona->primer_apellido }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>