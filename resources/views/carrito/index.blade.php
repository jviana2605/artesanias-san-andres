@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <h2 class="fw-bold mb-1">Carrito de compras</h2>
            <p class="text-muted mb-0">Revisa tus productos antes de confirmar el pedido.</p>
        </div>
        <a href="{{ route('home') }}" class="btn btn-sm btn-outline-secondary">
            ← Seguir comprando
        </a>
    </div>

    @if(empty($carrito))
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <h5 class="mb-2">Tu carrito está vacío</h5>
                <p class="text-muted mb-3">
                    Explora el catálogo y agrega artesanías para iniciar tu pedido.
                </p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    Ver catálogo de productos
                </a>
            </div>
        </div>
    @else
        <div class="row g-3">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm mb-3">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Productos en el carrito</h5>

                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead class="table-light">
                                <tr>
                                    <th>Producto</th>
                                    <th class="text-center" style="width:130px;">Cantidad</th>
                                    <th class="text-end">Precio</th>
                                    <th class="text-end">Subtotal</th>
                                    <th class="text-end" style="width:90px;"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($carrito as $item)
                                    <tr>
                                        <td>
                                            <span class="fw-semibold">{{ $item['nombre'] }}</span>
                                        </td>
                                        <td class="text-center">
                                            <form action="{{ route('carrito.actualizar', $item['producto_id']) }}"
                                                  method="POST" class="d-flex justify-content-center">
                                                @csrf
                                                <input type="number"
                                                       name="cantidad"
                                                       value="{{ $item['cantidad'] }}"
                                                       min="1"
                                                       class="form-control form-control-sm me-2"
                                                       style="width:70px">
                                                <button class="btn btn-sm btn-outline-secondary" type="submit">
                                                    ↻
                                                </button>
                                            </form>
                                        </td>
                                        <td class="text-end">
                                            $ {{ number_format($item['precio'], 0, ',', '.') }}
                                        </td>
                                        <td class="text-end">
                                            $ {{ number_format($item['subtotal'], 0, ',', '.') }}
                                        </td>
                                        <td class="text-end">
                                            <form action="{{ route('carrito.eliminar', $item['producto_id']) }}"
                                                  method="POST">
                                                @csrf
                                                <button class="btn btn-sm btn-outline-danger" type="submit">
                                                    ✕
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title mb-3">Resumen del pedido</h5>

                        <div class="d-flex justify-content-between mb-2">
                            <span class="text-muted">Total productos</span>
                            <span class="fw-semibold">{{ count($carrito) }}</span>
                        </div>

                        <hr>

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <span class="fw-semibold">Total a pagar</span>
                            <span class="fw-bold fs-5">
                                $ {{ number_format($total, 0, ',', '.') }}
                            </span>
                        </div>

                        <a href="{{ route('carrito.checkout') }}" class="btn btn-success w-100 mb-2">
                            Continuar con el pedido
                        </a>
                        <p class="small text-muted mb-0">
                            En el siguiente paso podrás ingresar tus datos de contacto para que el artesano
                            se comunique contigo y coordine la entrega.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
