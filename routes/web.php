<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtesanoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PedidoController;
use App\Models\Pedido;

// Página de inicio
Route::get('/', [ProductoController::class, 'index'])->name('home');

// Rutas de AUTENTICACIÓN de artesanos
Route::get('/registro', [ArtesanoController::class, 'registro'])->name('registro');
Route::post('/registro', [ArtesanoController::class, 'registrar'])->name('registrar');

Route::get('/login', [ArtesanoController::class, 'login'])->name('login');
Route::post('/login', [ArtesanoController::class, 'autenticar'])->name('autenticar');

Route::get('/logout', [ArtesanoController::class, 'logout'])->name('logout');


Route::get('/dashboard', function () {
    $user = auth()->user();

    $totalProductos    = $user->productos()->count();
    $totalPedidos      = Pedido::count();
    $pedidosPendientes = Pedido::where('estado', 'Pendiente')->count();
    $ventasTotales     = Pedido::sum('total');

    // Datos para la gráfica
    $pedidosPorEstado = [
        'Pendiente'   => Pedido::where('estado', 'Pendiente')->count(),
        'En proceso'  => Pedido::where('estado', 'En proceso')->count(),
        'Entregado'   => Pedido::where('estado', 'Entregado')->count(),
    ];

    return view('dashboard', compact(
        'user',
        'totalProductos',
        'totalPedidos',
        'pedidosPendientes',
        'ventasTotales',
        'pedidosPorEstado'
    ));
})->name('dashboard')->middleware('auth');



// CRUD de productos
Route::get('/productos', [ProductoController::class, 'index'])
    ->name('productos.index');

Route::get('/productos/crear', [ProductoController::class, 'crear'])
    ->middleware('auth')
    ->name('productos.crear');

Route::post('/productos/guardar', [ProductoController::class, 'guardar'])
    ->middleware('auth')
    ->name('productos.guardar');

Route::get('/productos/{producto}', [ProductoController::class, 'show'])
    ->name('productos.show');


// Carrito
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/agregar/{producto}', [CarritoController::class, 'agregar'])->name('carrito.agregar');
Route::post('/carrito/actualizar/{productoId}', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
Route::post('/carrito/eliminar/{productoId}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

Route::get('/checkout', [CarritoController::class, 'checkout'])->name('carrito.checkout');
Route::post('/checkout', [CarritoController::class, 'procesarPedido'])->name('carrito.procesar');
Route::get('/gracias/{pedido}', [CarritoController::class, 'gracias'])->name('carrito.gracias');

// Pedidos en dashboard (solo artesano logueado)
Route::get('/pedidos', [PedidoController::class, 'index'])
    ->middleware('auth')
    ->name('pedidos.index');

Route::get('/pedidos/{pedido}', [PedidoController::class, 'show'])
    ->middleware('auth')
    ->name('pedidos.show');

Route::post('/pedidos/{pedido}/estado', [PedidoController::class, 'actualizarEstado'])
    ->middleware('auth')
    ->name('pedidos.actualizarEstado');
