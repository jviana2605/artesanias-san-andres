<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function index(Request $request)
    {
        $query = Producto::query();

        if ($search = $request->get('q')) {
            $query->where(function ($q) use ($search) {
                $q->where('nombre', 'like', "%{$search}%")
                    ->orWhere('descripcion', 'like', "%{$search}%");
            });
        }

        if ($min = $request->get('min')) {
            $query->where('precio', '>=', $min);
        }

        if ($max = $request->get('max')) {
            $query->where('precio', '<=', $max);
        }

        if ($orden = $request->get('orden')) {
            if ($orden === 'precio_asc') {
                $query->orderBy('precio', 'asc');
            } elseif ($orden === 'precio_desc') {
                $query->orderBy('precio', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $productos = $query->get();

        return view('productos.index', compact('productos'));
    }

    public function crear()
    {
        return view('productos.crear');
    }

    public function guardar(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable',
            'imagen' => 'nullable|image'
        ]);

        $rutaImagen = null;

        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('productos', 'public');
        }

        Producto::create([
            'artesano_id' => Auth::id(),
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'imagen' => $rutaImagen,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }
}
