<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    // Lista de pedidos en el dashboard
    public function index()
    {
        $pedidos = Pedido::latest()->paginate(10);
        return view('pedidos.index', compact('pedidos'));
    }

    // Detalle de un pedido
    public function show(Pedido $pedido)
    {
        $pedido->load('items.producto');
        return view('pedidos.show', compact('pedido'));
    }

    public function actualizarEstado(Request $request, Pedido $pedido)
    {
        $request->validate([
            'estado' => 'required|in:Pendiente,En proceso,Entregado',
        ]);

        $pedido->estado = $request->estado;
        $pedido->save();

        return back()->with('success', 'Estado del pedido actualizado correctamente.');
    }
}
