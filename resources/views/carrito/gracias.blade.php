@extends('layouts.app')

@section('content')
    <h2 class="mb-4">¡Gracias por tu pedido!</h2>

    <p>Hemos registrado tu pedido #{{ $pedido->id }} por valor de
        <strong>$ {{ number_format($pedido->total, 0, ',', '.') }}</strong>.</p>

    <p>Pronto un artesano se comunicará contigo para coordinar la entrega.</p>

    <a href="{{ route('home') }}" class="btn btn-primary mt-3">Volver al catálogo</a>
@endsection
