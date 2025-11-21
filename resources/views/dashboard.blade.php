@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Panel del artesano</h2>
            <p class="text-muted mb-0">Resumen general de tu actividad en la plataforma.</p>
        </div>
        <span class="badge bg-dark-subtle text-dark-emphasis px-3 py-2 rounded-pill">
            Artesanías San Andrés
        </span>
    </div>

    <div class="row g-3 mb-4">
        {{-- Tarjeta de bienvenida --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <p class="text-muted mb-1">Bienvenido</p>
                    <h5 class="fw-semibold mb-1">{{ $user->nombre }}</h5>
                    <p class="small text-muted mb-0">
                        Gestione sus productos y pedidos desde este panel.
                    </p>
                </div>
            </div>
        </div>

        {{-- Productos publicados --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="text-muted mb-0">Productos publicados</p>
                        <span class="badge bg-primary-subtle text-primary-emphasis">Catálogo</span>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $totalProductos }}</h3>
                    <p class="small text-muted mb-0 mt-2">
                        Productos visibles en el catálogo público.
                    </p>
                </div>
            </div>
        </div>

        {{-- Pedidos totales --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="text-muted mb-0">Pedidos totales</p>
                        <span class="badge bg-info-subtle text-info-emphasis">Pedidos</span>
                    </div>
                    <h3 class="fw-bold mb-0">{{ $totalPedidos }}</h3>
                    <p class="small text-muted mb-0 mt-2">
                        Pendientes:
                        <span class="text-warning fw-semibold">{{ $pedidosPendientes }}</span>
                    </p>
                </div>
            </div>
        </div>

        {{-- Ventas totales --}}
        <div class="col-md-3">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="text-muted mb-0">Ventas totales</p>
                        <span class="badge bg-success-subtle text-success-emphasis">Ingresos</span>
                    </div>
                    <h3 class="fw-bold mb-0">
                        $ {{ number_format($ventasTotales, 0, ',', '.') }}
                    </h3>
                    <p class="small text-muted mb-0 mt-2">
                        Suma de todos los pedidos registrados en la plataforma.
                    </p>
                </div>
            </div>
        </div>
    </div>

    {{-- Acciones rápidas --}}
    <div class="d-flex flex-wrap gap-2">
        <a href="{{ route('productos.crear') }}" class="btn btn-primary">
            Crear nuevo producto
        </a>
        <a href="{{ route('pedidos.index') }}" class="btn btn-outline-secondary">
            Ver pedidos
        </a>
        <a href="{{ route('home') }}" class="btn btn-outline-dark">
            Ir al catálogo público
        </a>
    </div>
@endsection
