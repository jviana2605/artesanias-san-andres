@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Carrito de compras</h2>

    @if(empty($carrito))
        <p>Tu carrito está vacío.</p>
    @else
        <table class="table align-middle">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($carrito as $item)
                <tr>
                    <td>{{ $item['nombre'] }}</td>
                    <td>$ {{ number_format($item['precio'], 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('carrito.actualizar', $item['producto_id']) }}" method="POST" class="d-flex">
                            @csrf
                            <input type="number" name="cantidad" value="{{ $item['cantidad'] }}" min="1" class="form-control form-control-sm me-2" style="width:80px">
                            <button class="btn btn-sm btn-secondary" type="submit">Actualizar</button>
                        </form>
                    </td>
                    <td>$ {{ number_format($item['subtotal'], 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('carrito.eliminar', $item['producto_id']) }}" method="POST">
                            @csrf
                            <button class="btn btn-sm btn-danger" type="submit">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-between align-items-center">
            <h4>Total: $ {{ number_format($total, 0, ',', '.') }}</h4>
            <a href="{{ route('carrito.checkout') }}" class="btn btn-success">Continuar con el pedido</a>
        </div>
    @endif
@endsection
