@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-5 mb-3">
        <div class="card shadow-sm border-0">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="card-img-top" alt="{{ $producto->nombre }}">
            @else
                <div class="p-5 text-center text-muted">
                    Sin imagen
                </div>
            @endif
        </div>
    </div>

    <div class="col-md-7">
        <h2 class="mb-2">{{ $producto->nombre }}</h2>
        <h3 class="text-primary mb-3">$ {{ number_format($producto->precio, 0, ',', '.') }}</h3>

        <p class="mb-4">{{ $producto->descripcion }}</p>

        <form action="{{ route('carrito.agregar', $producto) }}" method="POST" class="d-flex gap-2 mb-3">
            @csrf
            <button type="submit" class="btn btn-lg btn-primary">
                Agregar al carrito
            </button>
            <a href="{{ route('productos.index') }}" class="btn btn-outline-secondary">
                Volver al catálogo
            </a>
        </form>

        <p class="text-muted small mb-0">
            Producto artesanal elaborado en San Andrés de Sotavento.
        </p>
    </div>
</div>
@endsection
