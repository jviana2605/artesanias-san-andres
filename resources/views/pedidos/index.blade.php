@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Gestión de pedidos</h2>

    @if($pedidos->isEmpty())
        <p>No hay pedidos registrados.</p>
    @else
        <table class="table table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($pedidos as $pedido)
                <tr>
                    <td>{{ $pedido->id }}</td>
                    <td>{{ $pedido->cliente_nombre }}</td>
                    <td>$ {{ number_format($pedido->total, 0, ',', '.') }}</td>
                    <td>{{ $pedido->estado }}</td>
                    <td>{{ $pedido->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <a href="{{ route('pedidos.show', $pedido) }}" class="btn btn-sm btn-outline-primary">
                            Ver detalle
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        {{ $pedidos->links() }}
    @endif
@endsection
