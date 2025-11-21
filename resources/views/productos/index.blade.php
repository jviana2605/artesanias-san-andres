@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Catálogo de productos artesanales</h2>

    <form method="GET" action="{{ route('productos.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="q" class="form-control"
                   placeholder="Buscar por nombre o descripción"
                   value="{{ request('q') }}">
        </div>

        <div class="col-md-2">
            <input type="number" name="min" class="form-control"
                   placeholder="Precio mín."
                   value="{{ request('min') }}">
        </div>

        <div class="col-md-2">
            <input type="number" name="max" class="form-control"
                   placeholder="Precio máx."
                   value="{{ request('max') }}">
        </div>

        <div class="col-md-2">
            <select name="orden" class="form-select">
                <option value="">Ordenar por</option>
                <option value="precio_asc"  {{ request('orden')=='precio_asc' ? 'selected' : '' }}>Precio ↑</option>
                <option value="precio_desc" {{ request('orden')=='precio_desc' ? 'selected' : '' }}>Precio ↓</option>
            </select>
        </div>

        <div class="col-md-2">
            <button class="btn btn-dark w-100" type="submit">Filtrar</button>
        </div>
    </form>

    @if($productos->isEmpty())
        <p>No hay productos que coincidan con la búsqueda.</p>
    @else
        <div class="row">
            @foreach($productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($producto->imagen)
                            <a href="{{ route('productos.show', $producto) }}">
                                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
                            </a>
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <a href="{{ route('productos.show', $producto) }}" class="text-decoration-none text-dark">
                                    {{ $producto->nombre }}
                                </a>
                            </h5>
                            <p class="card-text flex-grow-1">{{ Str::limit($producto->descripcion, 80) }}</p>
                            <p class="fw-bold">$ {{ number_format($producto->precio, 0, ',', '.') }}</p>

                            <form action="{{ route('carrito.agregar', $producto) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary w-100">
                                    Agregar al carrito
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
@endsection
