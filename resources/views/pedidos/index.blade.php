@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Gestión de pedidos</h2>
            <p class="text-muted mb-0">Consulta y administra los pedidos realizados por clientes.</p>
        </div>
        <span class="badge bg-info-subtle text-info-emphasis px-3 py-2 rounded-pill d-none d-md-inline">
            Área administrativa
        </span>
    </div>

    @if($pedidos->isEmpty())
        <div class="card border-0 shadow-sm text-center py-5">
            <h5 class="mb-2">No hay pedidos registrados</h5>
            <p class="text-muted mb-0">Los pedidos aparecerán aquí a medida que los clientes compren.</p>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                        <tr>
                            <th class="text-center" style="width:70px;">#</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th class="text-end" style="width:130px;"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($pedidos as $pedido)
                            <tr>
                                <td class="text-center fw-semibold">{{ $pedido->id }}</td>

                                <td class="fw-medium">{{ $pedido->cliente_nombre }}</td>

                                <td class="fw-semibold text-primary">
                                    $ {{ number_format($pedido->total, 0, ',', '.') }}
                                </td>

                                <td>
                                    @if($pedido->estado === 'Pendiente')
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
                                        <span class="badge bg-secondary">{{ $pedido->estado }}</span>
                                    @endif
                                </td>

                                <td>
                                    {{ $pedido->created_at->format('Y-m-d H:i') }}
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('pedidos.show', $pedido) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        Ver detalle
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

        <div class="mt-3">
            {{ $pedidos->links() }}
        </div>
    @endif
@endsection
