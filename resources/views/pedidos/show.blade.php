@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold mb-1">Detalle del pedido #{{ $pedido->id }}</h2>
            <p class="text-muted mb-0">Información del cliente y resumen de productos incluidos.</p>
        </div>
        <a href="{{ route('pedidos.index') }}" class="btn btn-sm btn-outline-secondary">
            ← Volver a pedidos
        </a>
    </div>

    <div class="row g-3">

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title mb-3">Datos del cliente</h5>

                    <p class="mb-1">
                        <strong>Nombre:</strong> {{ $pedido->cliente_nombre }}
                    </p>
                    <p class="mb-1">
                        <strong>Email:</strong> {{ $pedido->cliente_email ?? 'No registrado' }}
                    </p>
                    <p class="mb-3">
                        <strong>Teléfono:</strong> {{ $pedido->cliente_telefono ?? 'No registrado' }}
                    </p>

                    <hr>

                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div>
                            <p class="mb-1"><strong>Estado actual:</strong></p>
                            @if ($pedido->estado === 'Pendiente')
                                <span class="badge bg-warning-subtle text-warning-emphasis px-3 py-2">
                                    Pendiente
                                </span>
                            @elseif($pedido->estado === 'En proceso')
                                <span class="badge bg-info-subtle text-info-emphasis px-3 py-2">
                                    En proceso
                                </span>
                            @elseif($pedido->estado === 'Entregado')
                                <span class="badge bg-success-subtle text-success-emphasis px-3 py-2">
                                    Entregado
                                </span>
                            @else
                                <span class="badge bg-secondary px-3 py-2">
                                    {{ $pedido->estado }}
                                </span>
                            @endif
                        </div>
                    </div>

                    <form action="{{ route('pedidos.actualizarEstado', $pedido) }}" method="POST" class="row g-2 mt-2">
                        @csrf
                        <div class="col-md-6">
                            <label class="form-label small text-muted mb-1">Cambiar estado</label>
                            <select name="estado" class="form-select form-select-sm">
                                <option value="Pendiente" {{ $pedido->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente
                                </option>
                                <option value="En proceso" {{ $pedido->estado == 'En proceso' ? 'selected' : '' }}>En
                                    proceso</option>
                                <option value="Entregado" {{ $pedido->estado == 'Entregado' ? 'selected' : '' }}>Entregado
                                </option>
                            </select>
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button type="submit" class="btn btn-sm btn-primary w-100">
                                Actualizar estado
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card border-0 shadow-sm h-100">
                <div class="card-body">
                    <h5 class="card-title mb-3">Resumen del pedido</h5>

                    <p class="mb-1">
                        <strong>Fecha de creación:</strong>
                        {{ $pedido->created_at->format('Y-m-d H:i') }}
                    </p>

                    <p class="mb-1">
                        <strong>Cantidad de productos:</strong>
                        {{ $pedido->items->count() }}
                    </p>

                    <hr>

                    <p class="mb-1"><strong>Total del pedido:</strong></p>
                    <h4 class="fw-bold text-primary mb-0">
                        $ {{ number_format($pedido->total, 0, ',', '.') }}
                    </h4>

                    <p class="small text-muted mt-3 mb-0">
                        Este valor corresponde a la suma de todos los productos incluidos en el pedido.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm mt-4">
        <div class="card-body">
            <h5 class="card-title mb-3">Productos del pedido</h5>

            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Producto</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-end">Precio unitario</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedido->items as $item)
                            <tr>
                                <td>{{ $item->producto->nombre }}</td>
                                <td class="text-center">{{ $item->cantidad }}</td>
                                <td class="text-end">
                                    $ {{ number_format($item->precio_unitario, 0, ',', '.') }}
                                </td>
                                <td class="text-end">
                                    $ {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <h5 class="fw-bold mb-0">
                    Total: $ {{ number_format($pedido->total, 0, ',', '.') }}
                </h5>
            </div>
        </div>
    </div>
@endsection
