@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h2 class="fw-bold mb-2">Completar pedido</h2>
            <p class="text-muted mb-4">Ingresa tus datos para finalizar la compra.</p>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">

                    <form action="{{ route('carrito.procesar') }}" method="POST">
                        @csrf

                        <h5 class="fw-semibold mb-3">Información del cliente</h5>

                        <div class="mb-3">
                            <label class="form-label">Nombre completo <span class="text-danger">*</span></label>
                            <input type="text" name="cliente_nombre" class="form-control form-control-lg" required
                                placeholder="Ej: Juan Pérez">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Correo electrónico</label>
                            <input type="email" name="cliente_email" class="form-control form-control-lg"
                                placeholder="Ej: usuario@correo.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="text" name="cliente_telefono" class="form-control form-control-lg"
                                placeholder="Ej: 3001234567">
                        </div>

                        <h5 class="fw-semibold mt-4 mb-3">Resumen del pedido</h5>

                        <ul class="list-group mb-3">
                            @foreach ($carrito as $item)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="fw-semibold">{{ $item['nombre'] }}</span>
                                        <small class="text-muted">Cantidad: {{ $item['cantidad'] }}</small>
                                    </div>
                                    <span class="fw-bold">
                                        $ {{ number_format($item['subtotal'], 0, ',', '.') }}
                                    </span>
                                </li>
                            @endforeach

                            <li class="list-group-item d-flex justify-content-between fw-bold fs-5">
                                <span>Total a pagar</span>
                                <span>$ {{ number_format($total, 0, ',', '.') }}</span>
                            </li>
                        </ul>

                        <button type="submit" class="btn btn-success btn-lg w-100">
                            Confirmar pedido
                        </button>

                    </form>

                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('carrito.index') }}" class="text-muted">
                    ← Volver al carrito
                </a>
            </div>

        </div>
    </div>
@endsection
