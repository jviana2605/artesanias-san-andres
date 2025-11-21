@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold mb-1">Catálogo de productos artesanales</h2>
            <p class="text-muted mb-0">Explora las artesanías disponibles de San Andrés de Sotavento.</p>
        </div>
        <span class="badge bg-primary-subtle text-primary-emphasis px-3 py-2 rounded-pill d-none d-md-inline">
            Compras seguras y directas al artesano
        </span>
    </div>

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form method="GET" action="{{ route('productos.index') }}" class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label small text-muted mb-1">Búsqueda</label>
                    <input type="text" name="q" class="form-control"
                        placeholder="Nombre o descripción del producto" value="{{ request('q') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Precio mín.</label>
                    <input type="number" name="min" class="form-control" placeholder="0" value="{{ request('min') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Precio máx.</label>
                    <input type="number" name="max" class="form-control" placeholder="500000"
                        value="{{ request('max') }}">
                </div>

                <div class="col-md-2">
                    <label class="form-label small text-muted mb-1">Ordenar por</label>
                    <select name="orden" class="form-select">
                        <option value="">Relevancia</option>
                        <option value="precio_asc" {{ request('orden') == 'precio_asc' ? 'selected' : '' }}>Precio: menor a
                            mayor</option>
                        <option value="precio_desc" {{ request('orden') == 'precio_desc' ? 'selected' : '' }}>Precio: mayor a
                            menor</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-dark w-100" type="submit">Aplicar filtros</button>
                </div>
            </form>
        </div>
    </div>

    @if ($productos->isEmpty())
        <div class="alert alert-light border-0 shadow-sm">
            No se encontraron productos que coincidan con la búsqueda.
        </div>
    @else
        <div class="row g-3">
            @foreach ($productos as $producto)
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        @if ($producto->imagen)
                            <a href="{{ route('productos.show', $producto) }}">
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top"
                                    alt="{{ $producto->nombre }}" style="object-fit: cover; height: 220px;">
                            </a>
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">
                                <a href="{{ route('productos.show', $producto) }}" class="text-decoration-none text-dark">
                                    {{ $producto->nombre }}
                                </a>
                            </h5>

                            <p class="text-primary fw-bold mb-2">
                                $ {{ number_format($producto->precio, 0, ',', '.') }}
                            </p>

                            <p class="card-text flex-grow-1 text-muted small">
                                {{ \Illuminate\Support\Str::limit($producto->descripcion, 90) }}
                            </p>

                            <div class="d-grid gap-2 mt-2">
                                <form action="{{ route('carrito.agregar', $producto) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-primary w-100">
                                        Agregar al carrito
                                    </button>
                                </form>

                                <a href="{{ route('productos.show', $producto) }}"
                                    class="btn btn-sm btn-outline-secondary w-100">
                                    Ver detalle
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
