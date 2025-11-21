@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Datos del cliente</h2>

    <p>Revise su información para completar el pedido.</p>

    <form action="{{ route('carrito.procesar') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nombre completo *</label>
            <input type="text" name="cliente_nombre" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Correo electrónico</label>
            <input type="email" name="cliente_email" class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">Teléfono</label>
            <input type="text" name="cliente_telefono" class="form-control">
        </div>

        <h5 class="mt-4">Resumen del pedido</h5>
        <ul class="list-group mb-3">
            @foreach($carrito as $item)
                <li class="list-group-item d-flex justify-content-between">
                    <span>{{ $item['nombre'] }} x {{ $item['cantidad'] }}</span>
                    <span>$ {{ number_format($item['subtotal'], 0, ',', '.') }}</span>
                </li>
            @endforeach
            <li class="list-group-item d-flex justify-content-between fw-bold">
                <span>Total</span>
                <span>$ {{ number_format($total, 0, ',', '.') }}</span>
            </li>
        </ul>

        <button type="submit" class="btn btn-primary">Confirmar pedido</button>
    </form>
@endsection
