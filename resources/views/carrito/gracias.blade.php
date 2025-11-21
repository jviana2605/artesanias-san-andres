@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-lg-7">

            <div class="card border-0 shadow-sm text-center py-5 px-4">

                <div class="mb-4">
                    <span class="display-4 text-success">
                        ✔
                    </span>
                </div>

                <h2 class="fw-bold mb-2">¡Gracias por tu pedido!</h2>

                <p class="text-muted mb-4">
                    Hemos registrado tu pedido <strong>#{{ $pedido->id }}</strong>.
                </p>

                <h4 class="fw-semibold mb-3">
                    Total: $ {{ number_format($pedido->total, 0, ',', '.') }}
                </h4>

                <p class="text-muted px-4 mb-4">
                    Un artesano se comunicará contigo pronto para coordinar la entrega
                    y completar el proceso.
                </p>

                <a href="{{ route('home') }}" class="btn btn-primary btn-lg w-50 mx-auto">
                    Volver al catálogo
                </a>

            </div>

            <div class="text-center mt-4">
                <a href="{{ route('carrito.index') }}" class="text-muted small">
                    ¿Quieres ver tus productos nuevamente?
                </a>
            </div>

        </div>
    </div>
@endsection
