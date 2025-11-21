<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Http\Request;

class CarritoController extends Controller
{
    // Mostrar carrito
    public function index()
    {
        $carrito = session()->get('carrito', []);
        $total = collect($carrito)->sum(fn ($item) => $item['subtotal']);

        return view('carrito.index', compact('carrito', 'total'));
    }

    // Agregar producto al carrito
    public function agregar(Producto $producto)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$producto->id])) {
            $carrito[$producto->id]['cantidad']++;
            $carrito[$producto->id]['subtotal'] = $carrito[$producto->id]['cantidad'] * $carrito[$producto->id]['precio'];
        } else {
            $carrito[$producto->id] = [
                'producto_id' => $producto->id,
                'nombre'      => $producto->nombre,
                'precio'      => $producto->precio,
                'cantidad'    => 1,
                'imagen'      => $producto->imagen,
                'subtotal'    => $producto->precio,
            ];
        }

        session()->put('carrito', $carrito);

        return redirect()->back()->with('success', 'Producto agregado al carrito.');
    }

    // Actualizar cantidad
    public function actualizar(Request $request, $productoId)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            $cantidad = max(1, (int) $request->cantidad);
            $carrito[$productoId]['cantidad'] = $cantidad;
            $carrito[$productoId]['subtotal'] = $cantidad * $carrito[$productoId]['precio'];
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.index');
    }

    // Eliminar producto del carrito
    public function eliminar($productoId)
    {
        $carrito = session()->get('carrito', []);

        if (isset($carrito[$productoId])) {
            unset($carrito[$productoId]);
            session()->put('carrito', $carrito);
        }

        return redirect()->route('carrito.index');
    }

    // Formulario de checkout
    public function checkout()
    {
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.index')->withErrors('El carrito está vacío.');
        }

        $total = collect($carrito)->sum(fn ($item) => $item['subtotal']);

        return view('carrito.checkout', compact('carrito', 'total'));
    }

    // Procesar pedido
    public function procesarPedido(Request $request)
    {
        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->route('carrito.index')->withErrors('El carrito está vacío.');
        }

        $request->validate([
            'cliente_nombre'   => 'required',
            'cliente_email'    => 'nullable|email',
            'cliente_telefono' => 'nullable',
        ]);

        $total = collect($carrito)->sum(fn ($item) => $item['subtotal']);

        $pedido = Pedido::create([
            'cliente_nombre'   => $request->cliente_nombre,
            'cliente_email'    => $request->cliente_email,
            'cliente_telefono' => $request->cliente_telefono,
            'total'            => $total,
            'estado'           => 'Pendiente',
        ]);

        foreach ($carrito as $item) {
            PedidoItem::create([
                'pedido_id'       => $pedido->id,
                'producto_id'     => $item['producto_id'],
                'cantidad'        => $item['cantidad'],
                'precio_unitario' => $item['precio'],
                'subtotal'        => $item['subtotal'],
            ]);
        }

        // Vaciar carrito
        session()->forget('carrito');

        return redirect()->route('carrito.gracias', $pedido->id);
    }

    public function gracias(Pedido $pedido)
    {
        return view('carrito.gracias', compact('pedido'));
    }
}
