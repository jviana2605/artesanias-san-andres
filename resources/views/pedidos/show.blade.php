@extends('layouts.app')

@section('content')
    <h2 class="mb-3">Detalle del pedido #{{ $pedido->id }}</h2>

    <p><strong>Cliente:</strong> {{ $pedido->cliente_nombre }}</p>
    <p><strong>Email:</strong> {{ $pedido->cliente_email ?? 'No registrado' }}</p>
    <p><strong>Teléfono:</strong> {{ $pedido->cliente_telefono ?? 'No registrado' }}</p>
    <p><strong>Estado:</strong> {{ $pedido->estado }}</p>

    <p><strong>Estado actual:</strong> {{ $pedido->estado }}</p>

    <form action="{{ route('pedidos.actualizarEstado', $pedido) }}" method="POST" class="row g-2 mb-4">
        @csrf
        <div class="col-md-4">
            <select name="estado" class="form-select">
                <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                <option value="En proceso" {{ $pedido->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado</option>
            </select>
        </div>
        <div class="col-md-3">
            <button type="submit" class="btn btn-sm btn-primary">Actualizar estado</button>
        </div>
    </form>


    <h4 class="mt-4">Productos</h4>

    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedido->items as $item)
                <tr>
                    <td>{{ $item->producto->nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>$ {{ number_format($item->precio_unitario, 0, ',', '.') }}</td>
                    <td>$ {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h4 class="text-end mt-3">Total: $ {{ number_format($pedido->total, 0, ',', '.') }}</h4>

    <a href="{{ route('pedidos.index') }}" class="btn btn-secondary mt-3">Volver a pedidos</a>
@endsection
