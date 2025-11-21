<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Plataforma Artesanos - San Andrés de Sotavento</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f7;
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
        }

        .navbar {
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.07);
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: .03em;
        }

        .navbar-brand span {
            font-weight: 400;
            font-size: 0.8rem;
            opacity: .85;
        }

        .navbar-nav .nav-link {
            font-weight: 500;
            font-size: 0.95rem;
        }

        .navbar-nav .nav-link:hover {
            opacity: 0.85;
        }

        .card {
            border-radius: 0.9rem;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.04);
            border: none;
        }

        .btn {
            border-radius: .5rem;
        }

        .app-main {
            min-height: calc(100vh - 140px);
            padding-top: 1rem;
            padding-bottom: 2rem;
        }

        .app-footer {
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }

        .app-footer small {
            font-size: 0.8rem;
        }

        .alert {
            border-radius: 0.6rem;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand d-flex flex-column" href="{{ route('home') }}">
                Artesanías San Andrés
                <span>Plataforma digital de comercialización</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Inicio</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('carrito.index') }}">Carrito</a>
                    </li>

                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('pedidos.index') }}">Pedidos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos.crear') }}">Nuevo producto</a>
                        </li>

                        <li class="nav-item ms-lg-2">
                            <a class="nav-link" href="{{ route('logout') }}">Cerrar sesión</a>
                        </li>
                    @endauth

                    @guest
                        <li class="nav-item ms-lg-2">
                            <a class="nav-link" href="{{ route('login') }}">Iniciar sesión</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('registro') }}">Registrarse</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="app-main">
        <div class="container">

            @if (session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger mb-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="app-footer py-3 bg-white">
        <div class="container d-flex flex-column flex-md-row justify-content-between align-items-center">
            <small class="text-muted mb-2 mb-md-0">
                © {{ date('Y') }} Artesanías San Andrés de Sotavento. Todos los derechos reservados.
            </small>
            <small class="text-muted">
                Plataforma desarrollada como prototipo TRL5 – Proyecto de grado UNAD.
            </small>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    @yield('scripts')

</body>

</html>
